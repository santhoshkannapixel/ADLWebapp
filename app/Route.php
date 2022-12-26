<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

if(!function_exists('getAllRoutes')) {
    function getAllRoutes () {
        $routes = [];
        foreach (Route::getRoutes() as $value) {
            $unset = array(
                'login',
                'logut',
                'ignition.healthCheck',
                'ignition.healthCheck',
                'ignition.scripts',
                'ignition.styles',
                "ignition.executeSolution",
                "ignition.shareReport",
                "",
                "unisharp.lfm.show",
                "unisharp.lfm.getErrors",
                "unisharp.lfm.upload",
                "unisharp.lfm.getItems",
                "unisharp.lfm.move",
                "unisharp.lfm.domove",
                "unisharp.lfm.getAddfolder",
                "unisharp.lfm.getFolders",
                "unisharp.lfm.getCrop",
                "unisharp.lfm.getCropimage",
                "unisharp.lfm.getCropnewimage",
                "unisharp.lfm.getRename",
                "unisharp.lfm.getResize",
                "unisharp.lfm.performResize",
                "unisharp.lfm.getDownload",
                "unisharp.lfm.getDelete",
                "unisharp.lfm.",
            );
            $route_name = $value->getName();

            if(in_array($route_name,$unset)) {
                unset($route_name);
            } else {
                $explode = explode('.', $route_name);
                if(count($explode) > 0) {
                    $key = array_slice($explode,-2,1)[0];
                    if(isset($key) && $key != '') {
                        $routes[formatText($key)][] = $route_name;
                    }
                }
            }
        }
        return $routes;
    }
}

if(!function_exists('formatText')) {
    function formatText($text)
    {
        return str_replace(['-','_'],' ',$text);
    }
}

if(!function_exists('formatRoute')) {
    function formatRoute($text)
    {
        return strtoupper(str_replace(['.','-'],'_',$text));
    }
}
