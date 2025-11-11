<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'video_path', 
        'access_level',
        'duration',
        'expires_at'
    ];

    protected $casts = [
        'duration' => 'integer',
        'expires_at' => 'datetime'
    ];

    public function remainingWatchSeconds()
    {
        return $this->duration ? $this->duration * 60 : null;
    }

    public function remainingSeconds()
    {
        if (!$this->expires_at) return null;

        return now()->diffInSeconds($this->expires_at, false);
    }

    public function isExpired()
    {
        return $this->expires_at && now()->greaterThan($this->expires_at);
    }
}
