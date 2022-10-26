<?php

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
    
    'accept' => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute  solo puede contener letras.',
    'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'array' => 'El campo :attribute debe ser una matriz.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :fecha.',
    'entre' => [
        'numeric' => 'El campo :attribute  debe estar entre :min y :max.',
        'file' => 'El campo :attribute  debe estar entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El campo :attribute  debe tener entre :min y :max items.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmado' => 'La confirmación del campo :attribute no coincide.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :fecha.',
    'date_format' => 'El campo :attribute no coincide con el formato: formato.',
    'diferente' => 'El campo :attribute y otro deben ser diferentes.',
    'digits' => 'El campo :attribute  debe ser: digits digits.',
    'digits_between' => 'El campo :attribute  debe estar entre :min y :max digits.',
    'Dimensions' => 'El campo :attribute  tiene dimensiones de imagen no válidas.',
    'distinto' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El campo :attribute  debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes: :valores.',
    'existe' => 'El campo :attribute seleccionado: no es válido.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'fill' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :valor.',
        'file' => 'El campo :attribute debe ser mayor que :valor kilobytes.',
        'string' => 'El campo :attribute debe ser mayor que :valor caracteres.',
        'array' => 'El campo :attribute  debe tener más de: elementos de valor.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual que :valor.',
        'file' => 'El campo :attribute  debe ser mayor o igual que :valor kilobytes.',
        'string' => 'El campo :attribute debe ser mayor o igual que :valor caracteres.',
        'array' => 'El campo :attribute debe tener: elementos de valor o más.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El campo :attribute seleccionado: no es válido.',
    'in_array' => 'El campo de :attribute no existe en :other.',
    'integer' => 'El campo :attribute debe ser un entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'lt' => [
        'numeric' => 'El campo :attribute debe ser menor que :valor.',
        'file' => 'El campo :attribute  debe ser menor que :valor kilobytes.',
        'string' => 'El campo :attribute debe ser menor que :valor caracteres.',
        'array' => 'El campo :attribute debe tener menos que: elementos de valor.',
    ],
    'lte' => [
        'numeric' => 'El campo :attribute debe ser menor o igual que :valor.',
        'file' => 'El campo :attribute  debe ser menor o igual que :valor kilobytes.',
        'string' => 'El campo :attribute debe ser menor o igual que :valor caracteres.',
        'array' => 'El campo :attribute  no debe tener más de: elementos de valor.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'file' => 'El campo :attribute no puede ser mayor que :max kilobytes.',
        'string' => 'El campo :attribute no puede ser mayor que :max caracteres.',
        'array' => 'El campo :attribute no puede tener más de: elementos máximos.',
    ],
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :valores.',
    'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :valores.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El campo :attribute  debe ser al menos :min kilobytes.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'array' => 'El campo :attribute debe tener al menos: elementos mínimos.',
    ],
    'multiple_of' => 'El campo :attribute  debe ser un múltiplo de :valor',
    'not_in' => 'El campo :attribute seleccionado no es válido.',
    'not_regex' => 'El formato del campo :attribute no es válido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo de :attribute debe estar presente.',
    'regex' => 'El formato de :attribute no es válido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :valor.',
    'required_unless' => 'El campo de :attribute es obligatorio a menos que :other esté en :valores.',
    'required_with' => 'El campo de :attribute es obligatorio cuando :valores está presente.',
    'required_with_all' => 'El campo de :attribute es obligatorio cuando: hay valores presentes.',
    'required_without' => 'El campo de :attribute es obligatorio cuando: los valores no están presentes.',
    'required_without_all' => 'El campo de :attribute es obligatorio cuando ninguno de los valores: está presente.',
    'mismo' => 'El campo :attribute y: otro deben coincidir.',
    'tamaño' => [
        'numeric' => 'El campo :attribute  debe ser: tamaño.',
        'file' => 'El campo :attribute  debe ser: tamaño kilobytes.',
        'string' => 'El campo :attribute  debe ser: caracteres de tamaño.',
        'array' => 'El campo :attribute debe contener: artículos de tamaño.',
    ],
    'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes: :valores.',
    'string' => 'El campo :attribute debe ser una cadena.',
    'timezone' => 'El campo :attribute debe ser una zona válida.',
    'unique' => 'El campo :attribute  ya ha sido tomado.',
    'uploaded' => 'El campo :attribute no se pudo cargar.',
    'url' => 'El formato del campo :attribute no es válido.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',
    
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
