<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\FilesystemManager;

class CleanupCloudStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup-cloud-storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup all cloud storage files and directories';

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\FilesystemManager $filesystemManager
     */
    public function handle(FilesystemManager $filesystemManager): void
    {
        $storage = $filesystemManager->disk('ovh-swift');

        foreach ($storage->allDirectories() as $directory) {
            $storage->deleteDirectory($directory);

            $this->info("Deleted directory {$directory}");
        }

        foreach ($storage->allFiles() as $file) {
            $storage->delete($file);

            $this->info("Deleted file {$file}");
        }
    }
}
