<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class validateURL{

    public function handle(Request $request, Closure $closure){
        $url = $request->input('img');

            if(filter_var($url, FILTER_VALIDATE_URL)){
                return $closure($request);
            }
        return response(view('welcome', ["status"=> "URL de imagen no valida"]));
    }
}
?>