<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * Team type constants
     */
    public const TYPE_FAMILY = 'family';
    public const TYPE_CLASSROOM = 'classroom';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
        'team_type',
        'description',
        'settings',
        'educational_grade',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
            'settings' => 'array',
        ];
    }

    /**
     * Determine if the team is a family type.
     */
    public function isFamily(): bool
    {
        return $this->team_type === self::TYPE_FAMILY;
    }

    /**
     * Determine if the team is a classroom type.
     */
    public function isClassroom(): bool
    {
        return $this->team_type === self::TYPE_CLASSROOM;
    }
}
