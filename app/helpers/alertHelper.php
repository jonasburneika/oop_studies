<?php
namespace App\Helpers;

class AlertHelper
{
    public function showErrorAlert($message){
        return '<div class="alert alert-warning" role="alert">'.$message.'</div>';
    }

    public function showSuccessAlert($message){
        return '<div class="alert alert-success" role="alert">'.$message.'</div>';
    }
   
}
?>