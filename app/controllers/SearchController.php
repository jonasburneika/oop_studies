<?php

namespace App\Controllers;
use App\Libs\Controller;
use App\Models\Posts;
use App\Models\Users;
use App\Models\Search;

class SearchController extends Controller
{

    private $AjaxResult = [];
    public function search(){
        $search = new Search;
        $result = [];
        if (isset($_GET['q']) && isset($_GET['type'])){
            $query = $_GET['q'];
            $type = $_GET['type'];
            
            $this->addToResult($search->searchInSlug($query));
            $this->addToResult($search->searchInTitle($query));
            $this->addToResult($search->searchInContent($query));
            echo json_encode($this->AjaxResult);
        }
    }

    private function addToResult($result){
        if (!empty($result)){
            $this->AjaxResult[] = $result;
        }
    }
    
    public function index()
    {
               
        var_dump($_GET);
    }
}


?>