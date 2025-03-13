<?php


return [
    'permissions' => [
       'devices.add' => [
           'name' => 'Add Device',
           'allowed' => [
                'Administrator',
            ]      
       ],
       'devices.track' => [
           'name' => 'Track Device',
           'allowed' => [
                'Administrator',
           ]
       ],
       'devices.view' => [
           'name' => 'View Device',
           'allowed' => [
            'Administrator'
           ]
        ],
       'drivers.create' => [
           'name' => 'Create Driver',
           'allowed' => [
                'Administrator',
           ]
       ],
       'vehicles.view' => [
           'name' => 'View Vehicles',
           'allowed' => [
                'Administrator',
           ]
       ],
       'vehicles.add' => [
            'name' => 'Add Vehicle',
            'allowed' => [
                'Administrator',
            ]
       ],
       'orders.view' => [
           'name' => 'View Orders',
           'allowed' => [
                'Administrator',
                'Driver',
           ]
       ],
       'orders.create' => [
           'name' => 'Create Order',
           'allowed' => [
                'Administrator',
           ]
       ],
       'owned.order.view' => [
           'name' => 'View Owned Orders',
           'allowed' => [
                'Administrator',
                'Driver',
                'client',
           ]
       ],
       'owned.orders.create' => [
           'name' => 'Create Owned Order',
           'allowed' => [
                'Administrator',
                'Driver',
                'client',
           ]
       ],
       'users.create' => [
           'name' => 'Create User',
           'allowed' => [
                'Administrator',
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
                'Driver',
                'client',
           ]
       ],
    ],

    'roles' => [
        'Administrator' => [
            'name' => 'Administrator',   
        ],
        'Driver' => [
            'name' => 'Driver',
            
        ],
        'client' => [
            'name' => 'Client',
        ]
    ],

    'defaultRole' => 'Administrator',

];
