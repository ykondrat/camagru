<?php
    $routes = array(
        'camagru/photo_room' => 'camagru/photo',
        'camagru/about' => 'camagru/about',
        'camagru/sign_up' => 'account/create',
        'camagru/login' => 'account/login',
        'camagru/logout' => 'account/logout',
        'camagru/modify' => 'account/modify',
        'camagru/forgot' => 'account/forgot',
        'camagru/activation/([a-zA-Z]+)/([a-zA-Z0-9]+)' => 'account/activation/$1/$2',
        'camagru' => 'camagru/start',
    );

    return ($routes);