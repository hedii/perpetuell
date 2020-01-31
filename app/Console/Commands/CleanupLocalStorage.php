<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\FilesystemManager;

class CleanupLocalStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup-local-storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup all local storage files and directories';

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\FilesystemManager $filesystemManager
     */
    public function handle(FilesystemManager $filesystemManager): void
    {
        $storage = $filesystemManager->disk('local');

        foreach ($storage->allDirectories() as $directory) {
            if ($directory === 'public') {
                $this->line("Preserving directory {$directory}");

                continue;
            }

            $storage->deleteDirectory($directory);

            $this->info("Deleted directory {$directory}");
        }

        foreach ($storage->allFiles() as $file) {
            if (in_array($file, ['.gitignore', 'public/.gitignore'])) {
                $this->line("Preserving file {$file}");

                continue;
            }

            $storage->delete($file);

            $this->info("Deleted file {$file}");
        }
    }
}
