<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Role helpers ──────────────────────────────────────────────────────────

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function isFreelancer(): bool
    {
        return $this->role === 'freelancer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // ── Relationships ─────────────────────────────────────────────────────────

    public function freelancerProfile(): HasOne
    {
        return $this->hasOne(FreelancerProfile::class);
    }

    /** Skills linked to this user (via user_skills pivot). */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
                    ->withPivot('proficiency')
                    ->withTimestamps();
    }

    /** UserSkill pivot records (needed for endorsement lookups). */
    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    /** Projects this user posted as a client. */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }
}
