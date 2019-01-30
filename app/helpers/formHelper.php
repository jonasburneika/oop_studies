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
        $this->form .= ' /></br>';
    }
    public function inputGroup($inputfields) // OpenDiv OpenDivWithClass CloseDiv methods
    {
        $this->form .= '<div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">First and last name</span>
            </div>';
        $this->form .= $inputfields;
        $this->form .= '</div>';
    }

    public function getForm()
    {
        return $this->form;
    }

    public function checkbox()
    {

    }
}