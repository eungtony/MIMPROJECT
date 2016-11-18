<?php

namespace App\Http\Middleware;

use App\Agence;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class HeadProject
{

    protected $auth;
    const SUPERVISOR_GROUP_ID = 1;
    const BUREAU_GROUP_ID = 2;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = $this->auth->user()->id;
        $statut_id = $this->auth->user()->statut_id;
        $agence_id = $request->route()->getParameter('id');

        $agence = Agence::findOrFail($agence_id);
        $chef_id = $agence->user_id;

        if ($this->auth->guest()) {
            return response('Unauthorized.', 401);
        } else {
            if ($chef_id == $user_id ||
                $statut_id == self::SUPERVISOR_GROUP_ID ||
                $statut_id == self::BUREAU_GROUP_ID) {
                return $next($request);
            } else {
                return response('Unauthorized.', 401);
            }
        }
    }
}
