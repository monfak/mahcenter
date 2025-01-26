<?php

namespace App\Repositories\Contracts;

use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function findRole(int $roleId);

    public function destroyRole($role);
}
