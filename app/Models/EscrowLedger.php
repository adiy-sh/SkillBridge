<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscrowLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id',
        'payer_id',
        'payee_id',
        'amount',
        'status',
    ];

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }
}