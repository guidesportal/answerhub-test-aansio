<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 */
class Answer extends Model
{
    protected $fillable = [
        'answer',
        'answered_at',
    ];
    protected $casts = [
        'answered_at' => 'datetime',
    ];
    public $timestamps = true;

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'title', 'survey');
    }
}
