<?php

return [
    [
        'key'    => 'sales.payment_methods.mpesa',
        'name'   => 'M-Pesa',
        'sort'   => 1,
        'info'   => 'M-Pesa',
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ],
            [
                'name'          => 'image',
                'title'         => 'admin::app.configuration.index.sales.payment-methods.logo',
                'type'          => 'image',
                'info'          => 'admin::app.configuration.index.sales.payment-methods.logo-information',
                'channel_based' => false,
                'locale_based'  => false,
                'validation'    => 'mimes:bmp,jpeg,jpg,png,webp',
            ],
            [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'sandbox',
                'title'         => 'admin::app.admin.system.sandbox',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ], [
                'name'          => 'consumer_key',
                'title'         => 'M-Pesa Consumer Key',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ], [
                'name'          => 'consumer_secret',
                'title'         => 'M-Pesa Consumer Secret',
                'type'          => 'password',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ], [
                'name'          => 'shortcode',
                'title'         => 'M-Pesa Shortcode',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ], [
                'name'          => 'passkey',
                'title'         => 'M-Pesa Passkey',
                'type'          => 'password',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ], [
                'name'          => 'sort',
                'title'         => 'admin::app.admin.system.sort-order',
                'type'          => 'select',
                'validation'    => 'required',
                'options'       => [
                    [
                        'title' => '1',
                        'value' => 1
                    ], [
                        'title' => '2',
                        'value' => 2
                    ], [
                        'title' => '3',
                        'value' => 3
                    ], [
                        'title' => '4',
                        'value' => 4
                    ]
                ],
                'channel_based' => false,
                'locale_based'  => false,
            ]
        ]
    ]
];