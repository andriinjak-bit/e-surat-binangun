<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RotateLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:rotate {--days=30 : Jumlah hari minimum untuk dirotasi}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kompres log lama menjadi zip dan hapus dari database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $date = now()->subDays($days);
        
        $logs = \App\Models\ActivityLog::with('user')->where('created_at', '<', $date)->get();
        
        if ($logs->isEmpty()) {
            $this->info("Tidak ada log aktivitas yang usianya lebih dari {$days} hari.");
            return;
        }

        $filename = 'activity_logs_' . now()->format('Y_m_d_His');
        $csvPath = storage_path('app/' . $filename . '.csv');
        $zipPath = storage_path('app/logs_archive/' . $filename . '.zip');

        $archiveDir = storage_path('app/logs_archive');
        if (!is_dir($archiveDir)) {
            mkdir($archiveDir, 0755, true);
        }

        $file = fopen($csvPath, 'w');
        fputcsv($file, ['ID', 'Date', 'User', 'Action', 'Description']);
        foreach ($logs as $log) {
            fputcsv($file, [
                $log->id,
                $log->created_at,
                $log->user ? $log->user->name : 'Sistem / Guest',
                $log->action,
                $log->description
            ]);
        }
        fclose($file);

        $zip = new \ZipArchive;
        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $zip->addFile($csvPath, basename($csvPath));
            $zip->close();
        } else {
            $this->error('Gagal membuat file zip.');
            return;
        }

        unlink($csvPath);
        \App\Models\ActivityLog::where('created_at', '<', $date)->delete();

        $this->info("Berhasil mengompres {$logs->count()} data log ke dalam: {$zipPath} dan menghapusnya dari database.");
    }
}
