<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('superadmin') ?? false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return ($user->can('view events') && $this->familyCheck($user, $event))
            ? true : false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('edit events') ?? false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return ($user->can('edit events') && $this->familyCheck($user, $event))
            ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return ($user->can('edit events') && $this->familyCheck($user, $event))
            ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return ($user->can('edit events') && $this->familyCheck($user, $event))
            ? true : false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return ($user->can('edit events') && $this->familyCheck($user, $event))
            ? true : false;
    }

    /**
     * Run a superadmin check before checking any other permissions.
     *
     * @param User $user
     * @param string $ability
     * @return boolean|null
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        return null;
    }

    /**
     * Checks that the given model belongs to the user's family.
     *
     * @param User $user
     * @param Event $event
     * @return boolean
     */
    public function familyCheck(User $user, Event $event): bool
    {
        return $event->family_id === $user->family_id;
    }
}
