<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @method static create(array $fillable)
 */
class User extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];
    public $timestamps = true;

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
