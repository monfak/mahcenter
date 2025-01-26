<?php

use App\Utilities\ImageManager;

if (!function_exists('image_resize')) {
    /**
     * Retrieves a path of image along with it's final size.
     *
     * @param string $imagePath The full path of an image. e.g: "storage/images/categories/2018/11/image.jpg
     * @param string|array $size string means a name passes to the parameter and array means there is at least one of width or height index
     * @return bool if an error happens then return false
     */
    function image_resize($imagePath, $size) {
        return ImageManager::resize($imagePath, $size);
    }
}

if (!function_exists('image_aspect')) {
    /**
     * Retrieves a path of image along with its final aspect size.
     *
     * @param string $imagePath The full path of an image. e.g: "storage/images/categories/2018/11/image.jpg
     * @param string|array $size string means a name passes to the parameter and array means there is at least one of width or height index
     * @return bool if an error happens then return false
     */
    function image_aspect($imagePath, $size) {
        return ImageManager::aspectRatio($imagePath, $size);
    }
}
