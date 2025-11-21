<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
