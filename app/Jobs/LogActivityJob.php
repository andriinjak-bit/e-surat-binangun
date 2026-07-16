<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class LogActivityJob implements ShouldQueue
{
    use Queueable;

    public $userId;
    public $action;
    public $description;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $action, $description)
    {
        $this->userId = $userId;
        $this->action = $action;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \App\Models\ActivityLog::create([
            'user_id' => $this->userId,
            'action' => $this->action,
            'description' => $this->description,
        ]);
    }
}
