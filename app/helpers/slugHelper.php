<?php
namespace App\Helpers;

class SlugHelper
{
    private $slug = '';
    public function getSlug($title, $maxLength = 250){
        $title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $title);
        $this->slug = str_replace(' ', '-', $title); // Replaces all spaces with hyphens.
        $this->slug = preg_replace('/-+/', '-', $this->slug); // Replaces multiple hyphens with single one.
        $this->slug = preg_replace('/[^A-Za-z0-9\-]/', '', $this->slug); // Removes special chars.
        $this->slug = strtolower($this->slug);
        if (strlen($this->slug) > $maxLength){
            $this->slug = substr($this->slug, 0, $maxLength);
        }
        return $this->slug;
    }
}
?>