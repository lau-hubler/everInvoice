<?php

declare(strict_types=1);

return [
    'title' => 'Compradores y vendedores',
    'item' => 'stakeholder',
    'person' => [
        'title' => 'Persona Natural',
        'message' => 'Llene los campos para crear una nueva persona natural',
    ],

    'document' => [
        'title' => 'Documento',
        'label' => 'Documento:',
        'placeholder' => 'XXXXXXXXXX',
    ],
    'name' => [
        'title' => 'Nombre',
        'labelPerson' => 'Nombre:',
        'placeholderPerson' => 'Tus nombres',
        'labelCompany' => 'Nombre Comercial:',
        'placeholderCompany' => 'Nombre por cual la empresa es conocida'
    ],
    'surname' => [
        'label' => 'Apellidos:',
        'placeholder' => 'Tus apellidos',
    ],
    'company' => [
        'title' => 'Empresa',
        'label' => 'Razón Social:',
        'placeholder' => 'Nombre lo cual la empresa está registrada',
        'message' => 'Llene los campos para crear una nueva empresa',
    ],
    'email' => [
        'title' => 'Correo eletrónico',
        'label' => 'Correo eletrónico:',
        'placeholder' => 'tu_correo@email.com'
    ],
    'mobile' => [
        'title' => 'Celular',
        'label' => 'Celular:',
    ],
    'emptyMessage' => 'No hay personas o empresas registradas',
];
