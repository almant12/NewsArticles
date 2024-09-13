<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('articles', function ($user) {
    return true;
});
