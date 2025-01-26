<?php

namespace App\Repositories;

use App\Models\Slide;
use App\Repositories\Contracts\SlideRepositoryInterface;
use Illuminate\Http\Request;

class SlideRepository extends BaseRepository implements SlideRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Slide::class;
    }

    /**
     * @param Slide $slide
     * @return mixed
     */
    public function isNotSeen(Slide $slide)
    {
        return $slide->seen_at === null;
    }
}
