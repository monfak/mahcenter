<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByMobile($mobile): ?User;

    public function createToken($user);

    public function DeleteToken($user, $tokenId);

    public function DeleteTokens($user);

    public function deleteCurrentToken(User $user);

    public function assignRole(User $user, int $roleId);
}
