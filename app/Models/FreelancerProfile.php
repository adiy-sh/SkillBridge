<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FreelancerProfile extends Model
{
    protected $fillable = [
        'user_id', 'headline', 'bio', 'hourly_rate', 'availability',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class)->orderBy('sort_order');
    }
}

