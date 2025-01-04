<?php


return [
    'permissions' => [
       'devices.add',
       'devices.track',
       'devices.view',
       'drivers.create',
       'vehicles.view',
       'vehicles.add',
       'orders.view',
       'orders.create',
       'owned.order.view',
       'owned.orders.create',
       'users.create',
       'view.client.dashboard',
       'search.package',
    ],

    'roles' => [
        'admin' => [
            'name' => 'Administrator',
            'permissions' => [
                'devices.add',
                'devices.track',
                'devices.view',
                'drivers.create',
                'vehicles.view',
                'vehicles.add',
                'orders.view',
                'orders.create',
                'users.create',
            ]
            ],
        'client' => [
            'name'=> 'User',
            'permissions' => [
                'owned.order.view',
                'owned.orders.create',
                'view.client.dashboard',
            ]
        ]
    ],

    'defaultRole' => 'client'

];
