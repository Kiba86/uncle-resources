<?php

return [

    'installable' => [
        'Users' => [
            'description' => 'A resource that manages authentication, users and user profiles',
            'required' => []
        ],
        'Tags' => [
            'description' => 'A resource that manages an archive of tags',
            'required' => []
        ],
        'Galleries' => [
            'description' => 'A resource that manages an archive of images that can be connected to other resources',
            'required' => []
        ],
        'Languages' => [
            'description' => 'A resource that manages an archive of languages',
            'required' => []
        ],
        'Countries' => [
            'description' => 'A resource that manages an archive of countries',
            'required' => []
        ],
        'Comments' => [
            'description' => 'A resource that manages comment for various entity',
            'required' => [ 'Users' ]
        ],
        'Newsletters' => [
            'description' => 'A resource that connect Mailchimp subscribe',
            'required'    => [],
            'postinstall' => [
                'commands' => [
                    'vendor:publish' => [ '--provider' => 'Spatie\Newsletter\NewsletterServiceProvider' ]
                ]
            ]
        ],
        'ContactUs' => [
            'description' => 'A resource that add a ContactUs routing to api',
            'required'    => [],
            'postinstall' => [
                'commands' => [
                    'vendor:publish' => [ '--provider' => 'Spatie\Honeypot\HoneypotServiceProvider', '--tag' => 'config']
                ]
            ],
        ]
    ],

];