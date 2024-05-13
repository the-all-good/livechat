<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\ChatLink;
use App\Models\User;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
