<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class validateURL{

    public function handle(Request $request, Closure $closure){
        $url = $request->input('URL');

        if(isset($url)){
            if(isNull($url)){
                return redirect('/');
            }
        }
        return $closure($request);
    }
}
?>