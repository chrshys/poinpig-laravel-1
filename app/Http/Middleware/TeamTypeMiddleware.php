<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Jetstream\Jetstream;

class TeamTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $teamType): Response
    {
        // Get the current team
        $team = $request->user()?->currentTeam;

        // If no team or team doesn't match the required type, redirect to dashboard
        if (!$team || $team->team_type !== $teamType) {
            return redirect()->route('dashboard')->with('error', "This section requires a {$teamType} team.");
        }

        return $next($request);
    }
}
