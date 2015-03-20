<?php
use Lavender\Database\Attribute;
use Lavender\Database\Relationship;
use Lavender\Database\Scope;
return [

    'admin' => [
        'class' => 'App\Database\Admin',
        'attributes' => [
            'email' => [
                'label' => 'Email',
                'unique' => true,
            ],
            'password' => [
                'label' => 'Password',
            ],
            'remember_token' => [
                'label' => 'Remember Token',
                'nullable' => true,
            ],
        ],
    ],

    'cart' => [
        'class' => 'App\Database\Cart',
        'scope' => Scope::STORE,
        'relationships' => [
            'customer' => [
                'entity' => 'customer',
                'type' => Relationship::BELONGS_TO,
            ],
            'items' => [
                'entity' => 'cart_item',
                'type' => Relationship::HAS_MANY,
            ],
        ],
    ],

    'cart_item' => [
        'class' => 'App\Database\Cart\Item',
        'scope' => Scope::STORE,
        'attributes' => [
            'qty' => [
                'label' => 'Qty',
                'type' => Attribute::INTEGER,
            ]
        ],
        'relationships' => [
            'product' => [
                'entity' => 'product',
                'type' => Relationship::BELONGS_TO,
            ],
            'cart' => [
                'entity' => 'cart',
                'type' => Relationship::BELONGS_TO,
            ],
        ],
    ],

    'category' => [
        'class' => 'App\Database\Category',
        'scope' => Scope::DEPARTMENT,
        'attributes' => [
            'name' => [
                'label' => 'Name',
            ],
            'description' => [
                'label' => 'Description',
                'type' => Attribute::TEXT,
            ],
            'url' => [
                'label' => 'Url',
                'handler' => 'App\Handlers\Attributes\Category\Url'
            ],
        ],
        'relationships' => [
            'products' => [
                'entity' => 'product',
                'type' => Relationship::HAS_PIVOT,
                'table' => 'catalog_category_product',
            ],
            'parent' => [
                'entity' => 'category',
                'type' => Relationship::BELONGS_TO,
            ],
            'children' => [
                'entity' => 'category',
                'type' => Relationship::HAS_MANY,
            ],

        ],

    ],

    'customer' => [
        'class' => 'App\Database\Customer',
        'scope' => Scope::STORE,
        'attributes' => [
            'email' => [
                'label' => 'Email',
            ],
            'password' => [
                'label' => 'Password',
            ],
            'confirmation_code' => [
                'label' => 'Confirmation Code',
            ],
            'remember_token' => [
                'label' => 'Remember Token',
                'nullable' => true,
            ],
            'confirmed' => [
                'label' => 'confirmed',
                'type' => Attribute::BOOL,
                'default' => false,
            ],
        ],
        'relationships' => [
            'cart' => [
                'entity' => 'cart',
                'type' => Relationship::HAS_MANY,
            ],
        ],
    ],

    'reminder' => [
        'class' => 'App\Database\Reminder',
        'scope' => Scope::STORE,
        'attributes' => [
            'email' => [
                'label' => 'Email',
            ],
            'token' => [
                'label' => 'Token',
            ],
            'created_at' => [
                'label' => 'Created At',
                'type' => Attribute::TIMESTAMP,
            ],
        ],
    ],

    'product' => [
        'class' => 'App\Database\Product',
        'scope' => Scope::STORE,
        'attributes' => [
            'sku' => [
                'label' => 'Sku',
            ],
            'name' => [
                'label' => 'Name',
            ],
            'price' => [
                'label' => 'Price',
                'type' => Attribute::DECIMAL,
                'default' => 0.00,
            ],
            'url' => [
                'label' => 'Url',
                'handler' => 'App\Handlers\Attributes\Product\Url'
            ],
            'special_price' => [
                'label' => 'Special Price',
                'type' => Attribute::DECIMAL,
                'default' => 0.00,
            ],
        ],
        'relationships' => [
            'categories' => [
                'entity' => 'category',
                'type' => Relationship::HAS_PIVOT,
                'table' => 'catalog_category_product',
            ],
        ],
    ],

    'order' => [
        'class' => 'App\Database\Order',
        'attributes' => [
            'total' => [
                'label' => 'Total',
                'type' => Attribute::DECIMAL,
            ],
        ],
        'relationships' => [
            'customer' => [
                'entity' => 'customer',
                'type' => Relationship::BELONGS_TO,
            ],
            'status' => [
                'entity' => 'order_status',
                'type' => Relationship::BELONGS_TO,
            ],
            'items' => [
                'entity' => 'order_item',
                'type' => Relationship::HAS_MANY,
            ],
            'shipments' => [
                'entity' => 'order_shipment',
                'type' => Relationship::HAS_MANY,
            ],
            'payments' => [
                'entity' => 'order_payment',
                'type' => Relationship::HAS_MANY,
            ],
        ],
    ],

    'order_address' => [
        'class' => 'App\Database\Order\Address',
        'attributes' => [
            'name' => [],
            'street_1' => [],
            'street_2' => [],
            'city' => [],
            'region' => [],
            'country' => [],
            'postcode' => [],
            'phone' => [],
        ],
        'relationships' => [
        ],
    ],

    'order_item' => [
        'class' => 'App\Database\Order\Item',
        'attributes' => [
            'subtotal' => [
                'label' => 'Subtotal',
                'type' => Attribute::DECIMAL,
            ],
        ],
        'relationships' => [
            'product' => []
        ],
    ],

    'order_shipment' => [
        'class' => 'App\Database\Order\Shipment',
        'attributes' => [
            'method' => [],
            'subtotal' => [
                'label' => 'Subtotal',
                'type' => Attribute::DECIMAL,
            ],
        ],
        'relationships' => [
            'address' => [],
        ],
    ],

    'order_status' => [
        'class' => 'App\Database\Order\Status',
        'attributes' => [
            'status' => [],
        ],
        'relationships' => [
            'orders' => [
                'entity' => 'order',
                'type' => Relationship::HAS_MANY,
            ],
        ],
    ],

    'order_payment' => [
        'class' => 'App\Database\Order\Payment',
        'attributes' => [
            'method' => [],
            'subtotal' => [
                'label' => 'Subtotal',
                'type' => Attribute::DECIMAL,
            ],
        ],
        'relationships' => [
            'address' => [
                'entity' => 'order_address',
                'type' => Relationship::BELONGS_TO,
            ],
        ],
    ],

    'store' => [
        'class' => 'App\Database\Store',
        'attributes' => [
            'default' => [
                'label' => 'Default store',
                'type' => Attribute::BOOL,
                'default' => false,
            ],
        ],
        'relationships' => [
            'root_category' => [
                'entity' => 'category',
                'type' => Relationship::BELONGS_TO,
            ],
            'theme' => [
                'entity' => 'theme',
                'type' => Relationship::BELONGS_TO,
            ],
            'config' => [
                'entity' => 'store_config',
                'type' => Relationship::HAS_MANY,
            ],
        ],
    ],

    'store_config' => [
        'class' => 'App\Database\Store\Config',
        'scope' => Scope::STORE,
        'attributes' => [
            'key' => [
                'label' => 'Key',
            ],
            'value' => [
                'label' => 'Value',
            ],
        ],
        'relationships' => [
            'store' => [
                'entity' => 'store',
                'type' => Relationship::HAS_ONE,
            ],
        ],
    ],

    'theme' => [
        'class' =>  'App\Database\Theme',
        'scope' => Scope::STORE,
        'attributes' => [
            'code' => [
                'label' => 'Code',
                'unique' => true,
            ],
            'name' => [
                'label' => 'Name',
            ],
        ],
        'relationships' => [
            'parent' => [
                'entity' => 'theme',
                'type' => Relationship::HAS_ONE,
            ],
        ],
    ],

];
