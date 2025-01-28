<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validateURL{

    public function handle(Request $request, Closure $closure){
        $url = $request->route('URL');

        if(isset($url)){
            if($url){
                
            }
        }
        return $closure($request);
    }
}
?>