<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 */
class Question extends Model
{
    protected $fillable = [
        'question_text',
        'type',
    ];
    public $timestamps = true;

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'title', 'survey');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
