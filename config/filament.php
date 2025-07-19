<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | By uncommenting the Laravel Echo configuration, you may connect your
    | admin panel to any Pusher-compatible websockets server.
    |
    | This will allow your admin panel to receive real-time notifications.
    |
    */

    'broadcasting' => [

        // 'echo' => [
        //     'broadcaster' => 'pusher',
        //     'key' => env('VITE_PUSHER_APP_KEY'),
        //     'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
        //     'forceTLS' => true,
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Filament will use to put media. You may use any
    | of the disks defined in the `config/filesystems.php`.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    'auth' => [
        'pages' => [
            'login' => \App\Filament\Pages\Auth\Login::class,
            'register' => \App\Filament\Pages\Auth\Register::class,
        ],
    ],


    'panel-providers' => [
        App\Providers\Filament\SuperAdminPanelProvider::class,
        App\Providers\Filament\AdminPanelProvider::class,
        App\Providers\Filament\UserPanelProvider::class,
    ],

    //'home_url' => route('filament.pages.User.DashboardUser'),

];
