<?php
namespace App\Libs;

// include_once 'app/controllers/PostController.php';
class View
{

    private $viewCatalogPath = '/../views/';

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
            require $this->getContent('error');
        }
        $this->getFooter();
    }
    

    public function getHeader()
    {
        require $this->viewCatalogPath . 'header.php';
    }

    public function getContent($template)
    {
        require ($this->viewCatalogPath . $template . '.php');
    }

    public function getFooter()
    {
        require $this->viewCatalogPath . 'footer.php';
    }

    // public function headerNavigation()
    // {
    //     return $this->navigation;   
    // }

    public function getBanner($bannerUrl = 'banner')
    {
        require $this->viewCatalogPath . $bannerUrl . '.php';
    }

}