<?php

return [
    /*
    |-------------------------------------
    | Messenger display name
    |-------------------------------------
    */
    'name' => env('CHATIFY_NAME', 'Chatify Messenger'),

    /*
    |-------------------------------------
    | The disk on which to store added
    | files and derived images by default.
    |-------------------------------------
    */
    'storage_disk_name' => env('CHATIFY_STORAGE_DISK', 'public'),

    /*
    |-------------------------------------
    | Routes configurations
    |-------------------------------------
    */
    'routes' => [
        'prefix' => '', // احذف كلمة chat واحذف {tenant}.. اجعله فارغاً
        'middleware' => [],
        'namespace' => 'Chatify\Http\Controllers',
    ],
    
    'api_routes' => [
        'prefix' => '{tenant}/chatify/api', // تحديث مسار الـ API أيضاً
        'middleware' => [
            'api', 
            \Stancl\Tenancy\Middleware\InitializeTenancyByPath::class
        ],
        'namespace' => 'Chatify\Http\Controllers\Api',
    ],

    /*
    |-------------------------------------
    | Pusher API credentials
    |-------------------------------------
    */
    'pusher' => [
        'debug' => env('APP_DEBUG', false),
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER', 'mt1'),
            'host' => env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
            'port' => env('PUSHER_PORT', 443),
            'scheme' => env('PUSHER_SCHEME', 'https'),
            'encrypted' => true,
            'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
            'prefix' => (function_exists('tenant') && tenant('id')) ? tenant('id') . '_' : '',
        ],
    ],
'storage_disk' => 'public', // أو القرص الذي قمت بتعديله ليدعم التيننت
    /*
    |-------------------------------------
    | User Avatar
    |-------------------------------------
    */
    'user_avatar' => [
        // سيتم تخزين الأفاتار داخل: public/users-avatar/اسم_الشركة/
        'folder' => 'users-avatar/' . (function_exists('tenant') && tenant('id') ? tenant('id') : 'default'),
        'default' => 'avatar.png',
    ],

    /*
    |-------------------------------------
    | Gravatar
    |
    | imageset property options:
    | [ 404 | mp | identicon (default) | monsterid | wavatar ]
    |-------------------------------------
    */
    'gravatar' => [
        'enabled' => true,
        'image_size' => 200,
        'imageset' => 'identicon'
    ],

    /*
    |-------------------------------------
    | Attachments
    |-------------------------------------
    */
    'attachments' => [
        // سيتم تخزين الملفات داخل: public/attachments/اسم_الشركة/
        'folder' => 'attachments/' . (function_exists('tenant') && tenant('id') ? tenant('id') : 'default'),
        'download_route_name' => 'attachments.download',
        'allowed_images' => (array) ['png','jpg','jpeg','gif'],
        'allowed_files' => (array) ['zip','rar','txt'],
        'max_upload_size' => 150, 
    ],

    /*
    |-------------------------------------
    | Messenger's colors
    |-------------------------------------
    */
    'colors' => (array) [
        '#2180f3',
        '#2196F3',
        '#00BCD4',
        '#3F51B5',
        '#673AB7',
        '#4CAF50',
        '#FFC107',
        '#FF9800',
        '#ff2522',
        '#9C27B0',
    ],
    /*
    |-------------------------------------
    | Sounds
    | You can enable/disable the sounds and
    | change sound's name/path placed at
    | `public/` directory of your app.
    |
    |-------------------------------------
    */
    'sounds' => [
        'enabled' => true,
        'public_path' => 'sounds/chatify',
        'new_message' => 'new-message-sound.mp3',
    ]
];
