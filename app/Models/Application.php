<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getResumeUrlAttribute()
    {
        return $this->user ? asset('storage/cvs/' . $this->user->resume) : null;
    }

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
        if ($this->user) {
            if ($status === 'accepted') {
                $this->user->notify(new \App\Notifications\ApplicationAcceptedNotification($this));
            } elseif ($status === 'rejected') {
                $this->user->notify(new \App\Notifications\ApplicationRejectedNotification($this));
            }
        }
}
}