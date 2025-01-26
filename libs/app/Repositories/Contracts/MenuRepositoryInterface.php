<?php

namespace App\Repositories\Contracts;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
    public function getHeaderWithItems();
}
