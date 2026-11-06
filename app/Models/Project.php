<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['client_id', 'title', 'description', 'budget', 'deadline', 'status'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}