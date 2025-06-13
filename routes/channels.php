<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// ADMIN CHANNEL ==================================================================
Broadcast::channel('complaint-to-admin', function ($user) {
    return $user->role === 'admin';
});

Broadcast::channel('booking-class-to-admin', function ($user) {
    return $user->role === 'admin';
});

Broadcast::channel('confirm-complaint-to-admin', function ($user) {
    return $user->role === 'admin';
});


// USER CHANNEL ===================================================================
Broadcast::channel('response-complaint-to-user-{id}', function ($user, $id) {
    return $user->id === $id;
});

Broadcast::channel('response-booking-class-to-user-{id}', function ($user, $id) {
    return $user->id === $id;
});