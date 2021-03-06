<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * summary
 */
class Scripts_loader
{
    public function setScripts($paths = array()) {
    	if (!sizeof($paths)) {
    		return false;
    	}

    	$load_lines = array();
    	$filetype = array();

    	foreach ($paths as $src) {
    		preg_match("~([^.]+)$~", $src, $filetype);
            if (!preg_match("~^(http|https)://~", $src)) {
                $src = RAIZ.$src;
            }
    		switch($filetype[1]) {
    			case 'js':
    			array_push($load_lines, $this->newJs($src));
    			break;
    			case 'css':
    			array_push($load_lines, $this->newCss($src));
    			break;
    		}
    		$filetype = array();
    	}

    	return implode("", $load_lines);
    }

    private function clean($str) {
    	return preg_replace("~[ ]~", "", $str);
    }

    private function newCss($path) {
    	return "<link rel='stylesheet' type='text/css' href='".$path."'>";
    }

    private function newJs($path) {
    	return "<script type='text/javascript' src='".$path."'></script>";
    }
}