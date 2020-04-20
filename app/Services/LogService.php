<?php

use Illuminate\Support\Facades\Log;

class LogService
{
    public function writeLogException(string $name, \Exception $e, string $channel = 'errorlog', string $customMessage = '')
    {
        try {
            switch ($channel) {
                case 'default':
                    Log::info('===================' . $name . '===================');
                    Log::info('Error: ' . $e->getMessage());
                    Log::info('Line: ' . $e->getLine());
                    Log::info('File: ' . $e->getFile());
                    Log::info('Custom message: ' . $customMessage);
                    Log::info('==============================================================');
                    break;
                default:
                    Log::channel($channel)->info('===================' . $name . '===================');
                    Log::channel($channel)->info('Error: ' . $e->getMessage());
                    Log::channel($channel)->info('Line: ' . $e->getLine());
                    Log::channel($channel)->info('File: ' . $e->getFile());
                    Log::channel($channel)->info('Custom message: ' . $customMessage);
                    Log::channel($channel)->info('==============================================================');
                    break;
            }
        } catch (\Exception $e) {
            Log::info('================Error when write log Exception================');
            Log::info('Error: ' . $e->getMessage());
            Log::info('Line: ' . $e->getLine());
            Log::info('File: ' . $e->getFile());
            Log::info('==============================================================');
        }
    }

    public function writeLogCustom(string $name, string $message, string $channel = 'errorlog')
    {
        try {
            switch ($channel) {
                case 'default':
                    Log::info('===================' . $name . '===================');
                    Log::info('String: ' . $message);
                    Log::info('==============================================================');
                    break;
                default:
                    Log::channel($channel)->info('===================' . $name . '===================');
                    Log::channel($channel)->info('String: ' . $message);
                    Log::channel($channel)->info('==============================================================');
                    break;
            }
        } catch (\Exception $e) {
            Log::info('================Error when write log Exception================');
            Log::info('Error: ' . $e->getMessage());
            Log::info('Line: ' . $e->getLine());
            Log::info('File: ' . $e->getFile());
            Log::info('==============================================================');
        }
    }
}
