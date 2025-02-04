<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class validateURL{

    public function handle(Request $request, Closure $closure){
        $url = $request->route('img');

        if(isset($url)){
            if(isNull($url) || $url === "hola"){
                return redirect('/');
            }
        }
        return $closure($request);
    }
}
?>