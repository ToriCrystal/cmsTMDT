<input type="password" 
{{ $attributes
    ->class(['form-control'])
    ->merge([
        'placeholder' => __('password'),
        'autocomplete' => 'off'
    ])->merge($isRequired())
}} />