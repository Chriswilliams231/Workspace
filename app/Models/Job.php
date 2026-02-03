<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    protected $table = 'job_listings';

    protected $fillable = [
        'title', 
        'description', 
        'salary', 
        'tags', 
        'job_type', 
        'remote', 
        'requirements', 
        'benefits', 
        'address', 
        'city', 
        'state', 
        'zipcode', 
        'contact_email', 
        'contact_phone', 
        'company_name', 
        'company_description', 
        'company_logo', 
        'company_website',
        ];

      /**
       * Get the user that owns the Job
       *
       * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
       */
      public function user(): BelongsTo
      {
          return $this->belongsTo(User::class);
      }
}