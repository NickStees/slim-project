<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'csfr_key' => 'sdfsgdfgertegxcfgd',
        'app_hash' => 'sdfsdfsdfsd',

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
            // 'cache_path' => '/../cache/',
          'cache_path' => false,

        ],

        // database
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
            'database' => 'gcm',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',

        ],

        //mail
        'mail' => [
          'host' => '',
          'smtp_auth' => '',
          'smtp_secure' => '',
          'port' => '',
          'username' => '',
          'password' => '',
        ],


        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
