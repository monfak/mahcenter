<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return User::class;
    }

    /**
     * @param $mobile
     * @return User|null
     */
    public function findByMobile($mobile): ?User
    {
        return $this->getModel()->query()->where('mobile', $mobile)->first();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function createToken($user)
    {
        return $user->createToken('pakat')->plainTextToken;
    }

    /**
     * @param $user
     * @param $tokenId
     * @return void
     */
    public function DeleteToken($user, $tokenId)
    {
        $user->tokens()->where('id', $tokenId)->delete();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function DeleteTokens($user)
    {
        return $user->tokens()->delete();
    }

    public function deleteCurrentToken(User $user)
    {
        $user->currentAccessToken()->delete();
    }

    /**
     * @param User $user
     * @param int $roleId
     */
    public function assignRole(User $user, $roleId)
    {
        $role = Role::query()->find($roleId);
        if($role) {
            $user->assignRole($role);
        }
    }
}
