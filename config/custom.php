<?php


return [
    'permissions' => [
       'devices.add' => [
           'name' => 'Add Device',
           'allowed' => [
                'admin',
            ]      
       ],
       'devices.track' => [
           'name' => 'Track Device',
           'allowed' => [
                'admin',
           ]
       ],
       'devices.view' => [
           'name' => 'View Device',
        ],
       'drivers.create' => [
           'name' => 'Create Driver',
           'allowed' => [
                'admin',
           ]
       ],
       'vehicles.view' => [
           'name' => 'View Vehicles',
           'allowed' => [
                'admin',
           ]
       ],
       'vehicles.add' => [
            'name' => 'Add Vehicle',
            'allowed' => [
                'admin',
            ]
       ],
       'orders.view' => [
           'name' => 'View Orders',
           'allowed' => [
                'admin',
           ]
       ],
       'orders.create' => [
           'name' => 'Create Order',
           'allowed' => [
                'admin',
           ]
       ],
       'owned.order.view' => [
           'name' => 'View Owned Orders',
           'allowed' => [
                'admin',
                'client',
           ]
       ],
       'owned.orders.create' => [
           'name' => 'Create Owned Order',
           'allowed' => [
                'admin',
                'client',
           ]
       ],
       'users.create' => [
           'name' => 'Create User',
           'allowed' => [
                'admin',
           ]
       ],
       'view.client.dashboard' =>[
           'name' => 'View Client Dashboard',
           'allowed' => [
                'client',
           ]
       ],
       'search.package' => [
           'name' => 'Search Package',
           'allowed' => [
                'client',
           ]
       ],
    ],

    'roles' => [
        'admin' => [
            'name' => 'Administrator',   
        ],
        'client' => [
            'name'=> 'User',
        ]
    ],

    'defaultRole' => 'admin'

];
