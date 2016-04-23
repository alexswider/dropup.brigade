<?php
namespace App\View\Helper;

use Cake\View\Helper;

class AssetHelper extends Helper {
    
    const PRE_URL = 'https://s3-us-west-2.amazonaws.com/dropup';

    public function display($asset) {
        switch($asset->type) {
            case 'video':
                return $this->video($asset);
            case 'image':
                return $this->image($asset);
            case 'supergif':
                return $this->supergif($asset);
            case 'banner':
                return $this->banner($asset);
        }
    }
    
    private function image($asset) {
        return '<img src="' . self::PRE_URL . $asset->path . '" alt="' . $asset->description . '">';
    }
    
    private function video($asset) {
        $code = '<video width="'. $asset->width . '" height="' . $asset->height . '" controls>';
        $code .= '<source src="' . self::PRE_URL . $asset->path . '" type="video/mp4">';
        $code .= 'Your browser does not support the video tag.';
        $code .= '</video>';
        
        return $code;   
    }
    
    private function banner($asset) {
        return '<iframe width="' . $asset->width . '" height="' . $asset->height . '" src="' . self::PRE_URL . $asset->path . '/index.html"></iframe>';
    }
    
    private function supergif($asset) {
        $code = '<div class="supergif">';
        $gifs = explode(';', $asset->path);
        foreach($gifs as $gif) {
            if(strlen($gif) > 0) {
                $code .= '<img src="' . self::PRE_URL . $gif . '">';
            }
        }
        $code .= '</div>';
        
        return $code;
    }
}
