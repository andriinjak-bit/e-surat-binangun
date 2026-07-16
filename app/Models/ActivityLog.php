<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record($action, $description)
    {
        $userId = auth()->id();
        \App\Jobs\LogActivityJob::dispatch($userId, $action, $description);
    }
}
