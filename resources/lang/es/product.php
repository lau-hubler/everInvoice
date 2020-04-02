<?php

declare(strict_types=1);

return [
    'title' => 'Productos',
    'item' => 'producto',
    'code' => [
        'title' => 'Código',
        'label' => 'Código:',
        'placeholder' => 'XXX000',
    ],
    'name' => [
        'title' => 'Nombre',
        'label' => 'Nombre:',
        'placeholder' => 'Completa con el nombre de tu producto',
    ],
    'description' => [
        'title' => 'Descripción',
        'label' => 'Descripción:',
        'placeholder' => 'Describa tu producto',
    ],
    'price' => [
        'title' => 'Precio',
        'label' => 'Precio:',
        'placeholder' => '0,000.00',
    ],
    'category' => [
        'title' => 'Categoria (IVA)',
        'label' => 'Categoria:',
        'placeholder' => 'Seleccione la categoria de tu producto',
        'description' => "El iva del producto es dado por la categoria seleccionada",
    ],
    'emptyMessage' => 'No hay productos registradas!',
];
