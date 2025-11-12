<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

class BlockExplorerComponent extends Component
{
    public $url;
    public $token;

    public function init()
    {
        parent::init();
        // Vào https://3xpl.com/get-websockets-token để lấy token
        // https://3xpl.com/data/json-api/docs
        //  curl https://blockchain.info/rawaddr/3Pja5FPK1wFB9LkWWJai8XYL1qjbqqT9Ye
    }

    protected function getClient()
    {
        $url = 'https://svc.blockdaemon.com/universal/v1/bitcoin';
        $token = 'zpka_3c0f486683ae4130a53df5df43071fe8_16678ee3';
        return new Client([
            'baseUrl' => $url,
            'requestConfig' => [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/ld+json',
                ],
            ],
        ]);
    }

    public function callApi(string $endpoint, array $params = []): ?array
    {
        $request = $this->getClient()->get($endpoint, $params);
        $request->setOptions([
            CURLOPT_TIMEOUT => 600, // 10 minutes
            CURLOPT_CONNECTTIMEOUT => 120, // 2 minutes for connection
        ]);
        $response = $request->send();

        if (!$response->isOk) {
            Yii::error("3xpl API error: {$response->statusCode} {$response->content}", __METHOD__);
            return null;
        }

        return $response->data;
    }

    public function getAllEvents(string $address, string $network = 'bitcoin', int $maxRecords = 200): array
    {
        $sender = $address;
        $page = 1;
        $page_size = 100; // tối đa
        $recipients = [];
    
        do {
            $endpoint = "/mainnet/account/{$address}/txs?page={$page}&page_size={$page_size}";
            $response = $this->callApi($endpoint);
    
            if (empty($response['data'])) {
                break;
            }
    
            $txs = $response['data'];
    
            foreach ($txs as $tx) {
                foreach ($tx['events'] as $event) {
                    // Giao dịch GỬI: utxo_output với destination khác địa chỉ query
                    if ($event['type'] === 'utxo_output') {
                        $dest = $event['destination'];
                        $amount = $event['amount'];
                        if ($dest !== $sender && $dest !== 'unknown') {
                            $recipients[] = [
                                'tx_id' => $tx['id'],
                                'address' => $dest,
                                'amount_satoshi' => $amount,
                                'amount_btc' => covnertSatoShiToBTC($amount),
                                'date' => $tx['date'],
                                'type' => 'send' // đánh dấu là giao dịch gửi
                            ];

                            if (count($recipients) >= $maxRecords) {
                                break 3; // thoát tất cả vòng lặp
                            }
                        }
                    }
                    // Giao dịch NHẬN: utxo_input với source khác địa chỉ query
                    elseif ($event['type'] === 'utxo_input') {
                        $source = $event['source'];
                        $amount = $event['amount'];
                        if ($source !== $sender && $source !== 'unknown') {
                            $recipients[] = [
                                'tx_id' => $tx['id'],
                                'address' => $source,
                                'amount_satoshi' => $amount,
                                'amount_btc' => covnertSatoShiToBTC($amount),
                                'date' => $tx['date'],
                                'type' => 'receive' // đánh dấu là giao dịch nhận
                            ];

                            if (count($recipients) >= $maxRecords) {
                                break 3; // thoát tất cả vòng lặp
                            }
                        }
                    }
                }
            }
    
            $page++;
        } while (count($txs) === $page_size); // còn dữ liệu → tiếp tục trang tiếp theo
    
        // Tính tổng BTC gửi
        // $totalBtcSend = array_sum(array_column($recipients, 'amount_btc'));
    
        // echo '<pre style="color:red;">totalBtcSend === '; print_r($totalBtcSend); echo '</pre>';
        // echo '<pre style="color:red;">recipients === '; print_r($recipients); echo '</pre>';
        // die();
    
        return $recipients;
    }

    function countDuplicateAddresses(array $data): array {
        $counts = [];
        $amount_satoshi = [];

        // echo '<pre style="color:red";>$data === '; print_r($data);echo '</pre>';
        // die();
        foreach ($data as $item) {
            $address = $item['address'];
            if (!isset($counts[$address])) {
                $counts[$address] = 0;
                $amount_satoshi[$address] = 0;
            }
            $counts[$address]++;
            $amount_satoshi[$address] += $item['amount_satoshi'];
        }
    
        // Chuyển sang mảng kết quả
        $result = [];
        foreach ($counts as $address => $count) {
            $result[] = [
                'address' => $address,
                'count' => $count,
                'amount_satoshi' => $amount_satoshi[$address],
                'amount_btc' => covnertSatoShiToBTC($amount_satoshi[$address])
            ];
        }
    
        // Sort giảm dần theo count
        // usort($result, function($a, $b) {
        //     return $b['count'] <=> $a['count'];
        // });
    
        return $result;
    }
    
}
