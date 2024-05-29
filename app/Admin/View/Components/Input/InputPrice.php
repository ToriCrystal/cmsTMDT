<?php

namespace App\Admin\View\Components\Input;


class InputPrice extends Input
{
    public $required;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($required = false)
    {
        parent::__construct('text', $required);
    }

    public function isRequired(): array
    {
        return $this->required === true ? [
            'required' => true,
            'data-parsley-required-message' => __('msgValidateFieldEmpty')
        ] : [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.price');
    }
}
