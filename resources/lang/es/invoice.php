<?php

declare(strict_types=1);

return [
    'title' => 'Facturas',
    'item' => 'factura',
    'id' => 'Factura de venta #',
    'number' => [
        'title' => '# No.',
        'label' => 'Número de la factura:',
    ],
    'client' => [
        'title' => 'Cliente',
        'label' => 'Cliente:',
        'placeholder' => 'Seleccione el cliente de la factura ',
    ],
    'vendor' => [
        'title' => 'Vendedor',
        'label' => 'Vendedor:',
        'placeholder' => 'Seleccione el vendedor de la factura',
    ],
    'dueDate' => [
        'title' => 'Fecha de vencimiento',
        'label' => 'Fecha de vencimiento:',
    ],
    'deliveryDate' => [
        'title' => 'Fecha de entrega',
        'label' => 'Factura entrega en:',
    ],
    'invoiceDate' => [
        'title' => 'Fecha de emisión',
        'label' => 'Factura emitida en:',
    ],
    'status' => [
        'title' => 'Status',
        'label' => 'Status:',
        'placeholder' => 'Seleccione el status de la factura',
    ],
    'emptyMessage' => '¡No hay facturas registradas!',
];
