<?php
namespace App\Libs;
use App\Controllers;

class View
{

    private $viewCatalogPath = baseURL . 'app/views/';

    public function render($arParameters) 
    {         
        $this->getHeader();
        if (empty($arParameters)) $arParameters = ['getContent' => 'content'];

        if (is_array($arParameters)){
            if (count($arParameters) > 1){
                foreach ($arParameters as $key => $group) {
                    $method = key($group);
                    $variable = array_values($group)[0];
                    $this->$method($variable);
                }
            } else {
                $method = key($arParameters);
                $variable = array_values($arParameters)[0];
                $this->$method($variable);
            }
        } else {
            include $this->getContent('error');
        }
        $this->getFooter();
    }
    

    public function getHeader()
    {
       include $this->viewCatalogPath . 'header.php';
    }

    public function getContent($template)
    {
        include ($this->viewCatalogPath . $template . '.php');
    }

    public function getFooter()
    {
        include $this->viewCatalogPath . 'footer.php';
    }

    // public function headerNavigation()
    // {
    //     return $this->navigation;   
    // }

    public function getBanner($bannerUrl = 'banner')
    {
        include $this->viewCatalogPath . $bannerUrl . '.php';
    }

}