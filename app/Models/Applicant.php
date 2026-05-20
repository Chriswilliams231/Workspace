<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
   protected $fillable = [
        'user_id',
        'job_id',
        'fullname',
        'contact_email',
        'message',
        'location',
        'resume_path',
   ];
    // Relationship to the job
   public function job(): BelongsTo {
        return $this->belongsTo(Job::class);
   }
    // Relationship to the user
   public function user(): BelongsTo {
        return $this->belongsTo(User::class);
   }
}
