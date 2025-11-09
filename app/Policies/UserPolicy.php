<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, User $model): bool
    {
        return $admin->can('show_user');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('add_user');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, User $model): bool
    {
        return $admin->can('edit_user');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, User $model): bool
    {
        return $admin->can('delete_user');
    }
}
