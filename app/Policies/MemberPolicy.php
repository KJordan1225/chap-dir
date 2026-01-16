<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;

class MemberPolicy
{
    // Any authorized member can view the directory
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Member $member): bool
    {
        return true;
    }

    // Only superadmin can create/update/delete (admin-managed directory)
    public function create(User $user): bool
    {
        return (bool) $user->is_superadmin;
    }

    public function update(User $user, Member $member): bool
    {
        return (bool) $user->is_superadmin;
    }

    public function delete(User $user, Member $member): bool
    {
        return (bool) $user->is_superadmin;
    }

    // For bulk admin page
    public function massUpdate(User $user): bool
    {
        return (bool) $user->is_superadmin;
    }
}