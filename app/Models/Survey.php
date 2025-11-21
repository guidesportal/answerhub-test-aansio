<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\Uid\Factory\UlidFactory;

/**
 * @method static find(int $id)
 * @method static create(array $array)
 */
class Survey extends Model
{
    protected $primaryKey = 'title';
    public $keyType = 'string';
    public $incrementing = false;

    public function getKeyForSaveQuery()
    {
        $uf = new UlidFactory();
        return $uf->create()->toRfc4122();
    }

    protected $fillable = [
        'description',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public $timestamps = true;

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'survey', 'title');
    }
}
