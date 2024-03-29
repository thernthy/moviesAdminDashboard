<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear text messages from logs file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');
        // Read current content of the log file
        $logContent = file_get_contents($logPath);
        // Remove text messages from log content
        $clearedLogContent = preg_replace("/^\[.*\].*$/m", "", $logContent);
        // Write back the modified content to the log file
        file_put_contents($logPath, $clearedLogContent);
        $this->info('Text messages cleared from log file successfully.');
    }
}
