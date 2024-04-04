<?php

namespace App\Models;

use App\Traits\Supports\UsesUuid;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'dog',
    ];

    // Like relationship with user
    public function bidder(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scope to only include data by dog name
    public function scopeName(Builder $query, string $dog): Builder
    {
        return $query->whereJsonContains('dog->name', $dog);
    }

    // Scope to only include data by dog breed
    public function scopeBreed(Builder $query, string $breed): Builder
    {
        return $query->whereJsonContains('dog->breed', $breed);
    }

    public function scopeLiked(Builder $query, string $dog, string $breed): Builder
    {
        return $query->name($dog)->breed($breed);
    }
}
