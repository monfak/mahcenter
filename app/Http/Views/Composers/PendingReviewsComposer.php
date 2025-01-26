<?php

namespace App\Http\Views\Composers;

use App\Models\Review;
use Illuminate\Contracts\View\View;

class PendingReviewsComposer
{
    public function compose(View $view)
    {
        $pendingReviewsCount = Review::unseen()->count();
        $view->with('pendingReviewsCount', $pendingReviewsCount);
    }
}
