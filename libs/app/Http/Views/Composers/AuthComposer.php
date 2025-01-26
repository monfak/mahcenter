<?php

namespace App\Http\Views\Composers;

use Illuminate\Contracts\View\View;

class AuthComposer
{
    public function compose(View $view)
    {
        if (auth()->check())
        {
            $authUser = auth()->user();
            $view->with('authUser', $authUser);
        }
    }
}
