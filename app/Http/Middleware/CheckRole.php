<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika pengguna tidak memiliki peran yang diperlukan, Anda dapat mengarahkannya atau memberikan respons yang sesuai.
        return redirect()->back();
    }
}
