<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Role::class;
    }

    public function creates(array $parameters): Model
    {
        $roleData = [
            'name' => $parameters['name'],
            'display_name' => $parameters['display_name'],
            'content' => $parameters['content'],
            'is_deletable' => $parameters['is_deletable'] ?? true,
            'guard_name' => $parameters['guard_name'] ?? 'sanctum',
        ];
        return parent::create($roleData);
    }

    /**
     * @param int $roleId
     * @return mixed
     */
    public function findRole(int $roleId)
    {
        return $this->getModel()->findById($roleId);
    }

    /**
     * @param Role $role
     */
    public function destroyRole($role)
    {
        $role->delete();
    }
}
