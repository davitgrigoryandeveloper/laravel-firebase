<?php

namespace Esterox\Firebase\Facades;

use Illuminate\Support\Facades\Facade;

class FirebaseNotification extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'firebase-notification';
    }
}
