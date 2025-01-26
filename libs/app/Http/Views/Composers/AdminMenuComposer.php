<?php

namespace App\Http\Views\Composers;

use App\Utilities\MenuFactory;
use Illuminate\Contracts\View\View;

class AdminMenuComposer
{
    public function compose(View $view)
    {
        $userRoles = user_roles();
        $menus = MenuFactory::build();
        $userPermissions = MenuFactory::userPermissions();
        $view->with('userRoles', $userRoles);
        $view->with('menus', $menus);
        $view->with('userPermissions', $userPermissions);
    }
}
