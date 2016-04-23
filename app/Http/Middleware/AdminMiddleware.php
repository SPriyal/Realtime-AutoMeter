<?php namespace App\Http\Middleware;

use Closure;

class AdminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = \Auth::user();
		$associated_id = $user->asso_id;
		if($associated_id != 0) {
			return response(view('errors.401'),401);
		}
		return $next($request);
	}

}
