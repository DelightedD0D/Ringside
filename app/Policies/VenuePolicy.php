<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VenuePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->can('view-venues');
    }

    public function create(User $user)
    {
        return $user->can('create-venue');
    }

    public function show(User $user)
    {
        return $user->can('show-venue');
    }

    public function edit(User $user)
    {
        return $user->can('edit-venue');
    }

    public function delete(User $user)
    {
        return $user->can('delete-venue');
    }
}
