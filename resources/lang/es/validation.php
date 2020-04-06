<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :attribute debe ser aceptado/a.',
    'active_url' => ' :attribute no es una URL válida.',
    'after' => ' :attribute debe ser una fecha después de :date.',
    'after_or_equal' => ' :attribute debe ser una fecha después o igual a :date.',
    'alpha' => ' :attribute solo puede contener letras.',
    'alpha_dash' => ' :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => ' :attribute solo puede contener letras y números.',
    'array' => ' :attribute debe ser una cadena de caracteres.',
    'before' => ' :attribute debe ser una fecha antes de :date.',
    'before_or_equal' => ' :attribute debe ser una fecha antes o igual a :date.',
    'between' => [
        'numeric' => ' :attribute debe estar entre :min y :max.',
        'file' => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string' => ':attribute debe tener entre :min y :max caracteres.',
        'array' => ' :attribute debe tener entre :min y :max ítems.',
    ],
    'boolean' => ' :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'date' => ' :attribute no es una fecha válida.',
    'date_equals' => ' :attribute debe ser una fecha igual a :date.',
    'date_format' => ' :attribute no coincide con el formato :format.',
    'different' => ' :attribute y :other deben ser diferentes.',
    'digits' => ' :attribute debe tener :digits dígitos.',
    'digits_between' => ' :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => ' :attribute tiene dimensiones de imagen inválidas. ',
    'distinct' => ' :attribute tiene un valor duplicado.',
    'email' => ' :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => ' :attribute debe terminar con uno de los siguientes valores: :values.',
    'exists' => 'El campo :attribute seleccionado es inválido.',
    'file' => ' :attribute debe ser un archivo.',
    'filled' => ' :attribute debe contener un valor.',
    'gt' => [
        'numeric' => ' :attribute debe ser mayor a :value.',
        'file' => ' El :attribute debe ser mayor que :value kilobytes.',
        'string' => 'La cadena :attribute debe ser mayot que :value caracteres.',
        'array' => ' :attribute debe tener más de :value ítems.',
    ],
    'gte' => [
        'numeric' => ' :attribute debe ser mayor o igual que :value.',
        'file' => 'El :attribute debe ser mayor o igual a :value kilobytes.',
        'string' => 'La :attribute debe ser mayor o igual a :value caracteres.',
        'array' => 'El :attribute debe tener :value ítems o más.',
    ],
    'image' => ' :attribute debe ser una imagen.',
    'in' => 'El/la :attribute seleccionado/a es inválido/a.',
    'in_array' => ' :attribute no existe en :other.',
    'integer' => ' :attribute debe ser un entero.',
    'ip' => ' :attribute debe ser una dirección IP válida.',
    'ipv4' => ' :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => ' :attribute debe ser una dirección IPv6 válida.',
    'json' => ' :attribute debe ser una cadena de caracteres JSON válida.',
    'lt' => [
        'numeric' => ' :attribute debe ser menor que :value.',
        'file' => ' :attribute debe tener menos de :value kilobytes.',
        'string' => ' :attribute debe contener menos de :value caracteres.',
        'array' => ' :attribute debe tener menos de :value ítems.',
    ],
    'lte' => [
        'numeric' => ' :attribute debe ser menor o igual a :value.',
        'file' => ' :attribute debe ser menor o igual a :value kilobytes.',
        'string' => ' :attribute debe ser menor o igual que :value characters.',
        'array' => ' :attribute no debe tener más de :value ítems.',
    ],
    'max' => [
        'numeric' => ' :attribute no puede ser mayor que :max.',
        'file' => ' :attribute no puede tener más de :max kilobytes.',
        'string' => ' :attribute no puede tener más de :max caracteres.',
        'array' => ' :attribute no puede tener más de :max ítems.',
    ],
    'mimes' => ' :attribute debe ser un archive de tipo: :values.',
    'mimetypes' => ' :attribute debe ser un archive de tipo: :values.',
    'min' => [
        'numeric' => ' :attribute debe ser por lo menos :min.',
        'file' => ' :attribute debe ser al menos de :min kilobytes.',
        'string' => ' :attribute debe tener al menos :min caracteres.',
        'array' => ' :attribute debe tener al menos :min ítems.',
    ],
    'not_in' => 'El/la :attribute es inválido/a.',
    'not_regex' => 'El formato de :attribute es inválido.',
    'numeric' => ' :attribute debe ser un número.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo de :attribute debe estar presente.',
    'regex' => 'El formato de :attribute es inválido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless' => 'El campo :attribute es requerido a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es requerido cuando :values estén presentes.',
    'required_with_all' => 'El campo :attribute es requerido cuando :values estén presentes.',
    'required_without' => 'El campo :attribute es requerido cuando :values no están presentes.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de estos están presentes :values .',
    'same' => ' :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => ' :attribute debe ser :size.',
        'file' => ' :attribute debe ser :size kilobytes.',
        'string' => ' :attribute debe contener :size caracteres.',
        'array' => ' :attribute debe contener :size ítems.',
    ],
    'starts_with' => ' :attribute debe empezar con uno de los siguientes: :values.',
    'string' => ' :attribute debe ser una cadena de caracteres.',
    'timezone' => ' :attribute debe ser una zona horaria válida.',
    'unique' => ' :attribute ya ha sido tomado.',
    'uploaded' => ' :attribute falló para subir.',
    'url' => 'El formato de :attribute es inválido.',
    'uuid' => ' :attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
