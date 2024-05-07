<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
