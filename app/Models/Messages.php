<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'message'
    ];

    public function ChatLink(): BelongsTo
    {
        return $this->belongsTo(ChatLink::class);
    }
}
