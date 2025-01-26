<?php

namespace App\Http\Views\Composers;

use App\Models\InstallmentApplication;
use Illuminate\Contracts\View\View;

class UnseenInstallmentsComposer
{
    public function compose(View $view)
    {
        $unseenInstallmentsCount = InstallmentApplication::unseen()->count();
        $view->with('unseenInstallmentsCount', $unseenInstallmentsCount);
    }
}
