<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatLink extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETE = 'complete';

    protected $fillable = [
        'session',
        'email',
        'name',
        'status',
        'staff_id'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Messages::class, 'chat_id');
    }

    public function last_message()
    {
        return $this->messages->last();
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
