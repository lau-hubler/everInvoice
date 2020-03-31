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
        'placeholder' => '0,000.00',
    ],
    'category' => [
        'title' => 'Category (IVA)',
        'label' => 'Category:',
        'placeholder' => "Select your product's category",
        'description' => "The product's iva is given by the category selected",
    ],
    'emptyMessage' => 'There are no products to show',
];
