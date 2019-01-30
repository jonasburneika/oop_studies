<?php
namespace App\Helpers;
class FormHelper
{
    private $form = '';
    
    public function __construct($method, $action)
    {
        $this->form .='<form method="'.$method.'" action="'.$action.'">';
    }

    public function input($attributes)
    {
        if (array_key_exists('id', $attributes) && array_key_exists('label', $attributes)){
            $this->form .= '<label for="'.$attributes['id'].'">'.$attributes['label'].'</label>';
        }
        $this->form .= '<input ';
        foreach ($attributes as $name => $value) {
            if ($name != 'label') {
                $this->form .= ' '.$name .' ="'.$value.'"';
            }
        }
        $this->form .= ' />';
    }

    public function checkbox()
    {

    }
}