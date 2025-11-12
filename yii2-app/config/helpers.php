<?php

/**
 * Environment helper functions
 */

if (!function_exists('env')) {
    /**
     * Get environment variable with default value
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            $value = $_ENV[$key] ?? null;
        }
        return $value !== false && $value !== null ? $value : $default;
    }
}

if (!function_exists('env_bool')) {
    /**
     * Get boolean environment variable
     * @param string $key
     * @param bool $default
     * @return bool
     */
    function env_bool($key, $default = false)
    {
        $value = env($key, $default);
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}

if (!function_exists('env_int')) {
    /**
     * Get integer environment variable
     * @param string $key
     * @param int $default
     * @return int
     */
    function env_int($key, $default = 0)
    {
        $value = env($key, $default);
        return (int)$value;
    }
}

if (!function_exists('is_docker')) {
    /**
     * Check if running in Docker environment
     * @return bool
     */
    function is_docker()
    {
        return env_bool('DOCKER_ENV', false) || file_exists('/.dockerenv');
    }
}

if (!function_exists('is_production')) {
    /**
     * Check if running in production environment
     * @return bool
     */
    function is_production()
    {
        return env('YII_ENV') === 'prod';
    }
}

if (!function_exists('is_development')) {
    /**
     * Check if running in development environment
     * @return bool
     */
    function is_development()
    {
        return env('YII_ENV') === 'dev';
    }
}

if (!function_exists('writeLog')) {
    function writeLog($message, $file = 'email_log.log'): void
    {
        try {            
            // Normalize complex message types without losing structure
            if (is_object($message)) {
                if ($message instanceof \JsonSerializable) {
                    $message = $message->jsonSerialize();
                } elseif (method_exists($message, 'toArray')) {
                    $message = $message->toArray();
                } else {
                    $message = json_decode(json_encode($message, JSON_UNESCAPED_UNICODE), true);
                }
            } elseif (is_resource($message)) {
                $message = sprintf('resource(%s)', get_resource_type($message));
            }

            if (!is_array($message) && !is_scalar($message) && $message !== null) {
                $message = (string) $message;
            }
            
            $logData = ['message' => $message];
            $logMessage = json_encode($logData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n";
            $logFile = Yii::getAlias('@runtime/logs/custom/' . $file);
            
            // Ensure log directory exists
            $logDir = dirname($logFile);
            if (!is_dir($logDir)) mkdir($logDir, 0755, true);
            file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
        } catch (\Exception $e) {
            // Log the error but don't throw it to avoid breaking the main operation
            Yii::error('Error logging custom message: ' . $e->getMessage());
        }
    }
}

if (!function_exists('covnertSatoShiToBTC')) {
    function covnertSatoShiToBTC(int $satoshi): float
    {
        return $satoshi / 100000000;
    }
}