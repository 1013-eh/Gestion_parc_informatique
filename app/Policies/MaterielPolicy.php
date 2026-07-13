<?php

namespace App\Policies;

use App\Models\Materiel;
use App\Models\User;

class MaterielPolicy
{
    public function modify(User $user, ?Materiel $materiel = null): bool
    {
        return $user->isAdmin();
    }
}
