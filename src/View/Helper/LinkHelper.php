<?php
namespace App\View\Helper;

use Cake\View\Helper;

class LinkHelper extends Helper
{
    public $helpers = ['Html'];

    public function dropupLink($isCdn, $url)
    {
        if ($isCdn) {
            $url = "https://s3-us-west-2.amazonaws.com/dropup/" . $url;
        }

        return $this->Html->Url->build($url);
    }
}