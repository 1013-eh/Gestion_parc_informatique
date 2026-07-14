<?php

namespace App\Policies;

use App\Models\Archive;
use App\Models\User;

class ArchivePolicy
{
    public function modify(User $user, ?Archive $archive = null): bool
    {
        return $user->isAdmin();
    }
}