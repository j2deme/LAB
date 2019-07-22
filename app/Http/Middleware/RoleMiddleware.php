<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
  /**
   * Verifica el rol del usuario.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param String $role
   * @return mixed
   */
  public function handle($request, Closure $next, $role)
  {
    if(!$request->user()->hasRole($role)) {
      abort(404);
    }
    return $next($request);
  }
}
