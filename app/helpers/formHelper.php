<?php
namespace App\Helpers;
class FormHelper
{
    private $form = '';
    
    public function __construct($method, $action, $class=null)
    {
        $this->form .='<form method="'.$method.'" action="'.indexURL.'index.php/'.$action.'"';
        
        if(!empty($class)){
            $this->form .=' class="'.$class.'"';
        }
        $this->form .= '>';
    }

    public function input($attributes)
    {
        $this->form .= '<input ';
        foreach ($attributes as $name => $value) {

            $this->form .= ' '.$name .' ="'.$value.'"';
            
        }
        $this->form .= ' />';
    }

    public function label($for=null, $title=null)
    {
        $this->form .= '<label for="'.$for.'">'.$title.'</label>';
    }

    public function addHTML($HTML)
    {
        $this->form .= $HTML;
    }

    public function button($attributes, $title)
    {
        $this->form .= '<button';
        if (is_array($attributes)){
            foreach ($attributes as $name => $value) {
                $this->form .= ' '.$name .' ="'.$value.'"';
            }
            $this->form .= ' >' . $title;
        } else {
            $this->form .= '>' . $title;
        }
        $this->form .= '</button>';
    }

    public function openDiv($attributes)
    {
        $this->form .= '<div';
        if (is_array($attributes)){
            foreach ($attributes as $name => $value) {
                $this->form .= ' '.$name .' ="'.$value.'"';
            }
            $this->form .= ' >';
        } else {
            $this->form .= '>';
        }
        
    }

    public function closeDiv()
    {
        $this->form .= '</div>';
    }

    public function addSpan($attributes, $content = null)
    {
        $this->form .= '<span';
        if (is_array($attributes)){
            foreach ($attributes as $name => $value) {
                $this->form .= ' '.$name .' ="'.$value.'"';
            }
        }
        $this->form .= ' >';
        if (!empty($content)){
            $this->form .= $content;
        }
        $this->form .= '</span>';
    }

    public function getForm()
    {
        $this->form .= '</form>';
        return $this->form;
    }

    public function checkbox($attributes,$title = null, $checked = false)
    {
        $this->form .= '<input type="checkbox"';
        if (is_array($attributes)){
            foreach ($attributes as $name => $value) {
                $this->form .= ' '.$name .' ="'.$value.'"';
            }
            $this->form .= ' >';
        } else {
            $this->form .= '>';
        }
        $this->form .= $title;
        //  <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>
    }
}