<?php

namespace App\Utils;

class Logger
{
    public static function log(string $message): void
    {
        $logFile = __DIR__ . '/../../logs/app.log';
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
    }
}
