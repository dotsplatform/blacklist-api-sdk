<?php

return [
    'blacklist-server' => [
        'host' => env('RESOURCES_BLACKLIST_EXTERNAL_HOST', 'https://blacklist.dots.live/'),
        'token' => env('BLACKLIST_INTERNAL_GATEWAY_TOKEN'),
    ],
];
