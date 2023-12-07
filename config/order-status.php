<?php

return [
    'order_status_admin' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your pacakge has been processed and will be with our delivey partner soon'
        ],
        'dropped_off' => [
            'status' => 'Dropped off',
            'details' => 'Your pacakge has been dropped off by the seller'
        ],
        'shipped' => [
            'status' => 'Shipped',
            'details' => 'Your pacakge has arrived at our logistics facality'
        ],
        'out_for_delivery' => [
            'status' => 'Out For Delivery',
            'details' => 'Your delivery partner will attempt to deliver your package'
        ],
        'delivered' => [
            'status' => 'Delivered',
            'details' => 'Delivered'
        ],

        'cancel' => [
            'status' => 'Canceled',
            'details' => 'Canceled'
        ]
    ],

    'order_status_vendor' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your pacakge has been processed and will be with our delivey partner soon'
        ]

    ]

];
