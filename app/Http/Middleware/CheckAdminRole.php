<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $role = $user->getRole();

        if ($role === config('product.role.admin'))
        {
            return $next($request);
        }

        if ($request->isMethod('post') && $request->isMethod('put'))
        {
            if ($request->has('article'))
            {
                return redirect()->back()->with('success','Вы не можете редактировать артикул');
            }
        }

        return $next($request);
    }
}
