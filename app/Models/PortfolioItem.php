<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioItem extends Model
{
    protected $fillable = [
        'freelancer_profile_id', 'title', 'type',
        'description', 'url', 'file_path', 'sort_order',
    ];

    public function freelancerProfile(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class);
    }
}

