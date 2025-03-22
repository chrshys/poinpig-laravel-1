<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;

class UpdateTeamName implements UpdatesTeamNames
{
    /**
     * Validate and update the given team's name.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, Team $team, array $input): void
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'team_type' => ['sometimes', 'required', 'string', 'in:family,classroom'],
            'description' => ['nullable', 'string', 'max:1000'],
            'educational_grade' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'name' => $input['name'],
        ])->save();

        // Only update these fields if they're provided
        if (isset($input['team_type'])) {
            $team->forceFill([
                'team_type' => $input['team_type'],
                'description' => $input['description'] ?? $team->description,
                'educational_grade' => isset($input['team_type']) && $input['team_type'] === 'classroom' 
                    ? ($input['educational_grade'] ?? $team->educational_grade) 
                    : null,
            ])->save();
        }
    }
}
