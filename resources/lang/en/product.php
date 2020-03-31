<?php

declare(strict_types=1);

return [
    'title' => 'Products',
    'item' => 'product',
    'code' => [
        'title' => 'Code',
        'label' => 'Code:',
        'placeholder' => 'XXX000',
    ],
    'name' => [
        'title' => 'Name',
        'label' => 'Name:',
        'placeholder' => "Enter your product's name",
    ],
    'description' => [
        'title' => 'Description',
        'label' => 'Description:',
        'placeholder' => 'Describe your product',
    ],
    'price' => [
        'title' => 'Price',
        'label' => 'Price:',
        'placeholder' => '$00.00',
        'description' => "Type your product's price",
    ],
    'category' => [
        'title' => 'Category (IVA)',
        'label' => 'Category:',
        'placeholder' => "Select your product's category"
    ],
    'emptyMessage' => 'There are no products to show',
];
