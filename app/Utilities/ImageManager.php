<?php
/**
 * @author: Mojtaba Pakzad
 * @package Anisa
 */

namespace App\Utilities;

use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

/**
 * Class ImageManipulation
 * This class needs to Intervention/Iamge class to work.
 * @see http://image.intervention.io/
 * @package Anisa
 */
class ImageManager
{
    /**
     * Retrieves a path of image along with it's final size.
     *
     * @param string $imagePath The full path of an image. e.g: "storage/images/categories/2018/11/image.jpg
     * @param string|array $size string means a name passes to the parameter and array means there is at least one of width or height index
     * @return bool if an error happens then return false
     */
    public static function resize($imagePath, $size)
    {
        
        // return $imagePath;
        if (!File::exists($imagePath)) {
            return $imagePath;
        }

        $resizedImage = self::getResizeName($imagePath, $size);

        if(!File::exists($resizedImage)) {
            try {
                if (is_array($size)) {
                    Image::read($imagePath)->resize($size['width'], $size['height'])->save($resizedImage );
                } else {
                    Image::read($imagePath)->resize($size)->save($resizedImage );
                }
            } catch (\Exception $e) {
                \Log::error('Failed to process image: ' . $imagePath . ' Error: ' . $e->getMessage());
            }
        }
        return $resizedImage;
    }

    /**
     * Retrieves the image path and its final size and return the new file name.
     *
     * @param string $imagePath
     * @param $size
     * @return bool|string
     */
    public static function getResizeName($imagePath, $size)
    {
        if (is_null($size)) {
            return false;
        }

        if (is_array($size)) {
            if (!array_key_exists('width', $size) && !array_key_exists('height', $size)) {
                return false;
            }

            if (array_key_exists('width', $size)) {
                if (!is_int($size['width'])) {
                    $size['width'] = null;
                }
            }

            if (array_key_exists('height', $size)) {
                if (!is_int($size['height'])) {
                    $size['height'] = null;
                }
            }

            $sizeExtension = '-' . $size['width'] . 'x' . $size['height'];
        } else {
            if (!in_array($size, ['small', 'medium', 'large'])) {
                return false;
            }
            $sizeExtension  = '-' . $size;
        }


        $name       = File::name($imagePath);
        $directory  = File::dirname($imagePath);
        $extension  = File::extension($imagePath);

        if(!File::exists($imagePath)) {
            return false;
        }

        return $directory . '/' . $name . $sizeExtension . '.' . $extension;
    }
    
    /**
     * Resize the image to a width or height of specific size and constrain aspect ratio (auto height and auto width).
     *
     * @param string $imagePath The full path of an image. e.g: "storage/images/categories/2018/11/image.jpg
     * @param string|array $size string means a name passes to the parameter and array means there is just one of width or height index
     * @return bool|string if an error happens then return false, otherwise path of image
     */
    public static function aspectRatio($imagePath, $size)
    {
        if (!File::exists($imagePath)) {
            return $imagePath;
        }

        if (is_null($size)) {
            return false;
        }

        $width  = null;
        $height = null;
        if (is_array($size)) {
            if (!array_key_exists('width', $size) && !array_key_exists('height', $size)) {
                return false;
            }

            if (array_key_exists('width', $size)) {
                if (is_int($size['width'])) {
                    $width  = $size['width'];
                    $sizeExtension = '-w' . $width;
                }
            }

            if (array_key_exists('height', $size)) {
                if (is_int($size['height'])) {
                    $height = $size['height'];
                    $sizeExtension = '-h' . $height;
                }
            }

        } else {
            $width  = $size;
            $height = null;
            $sizeExtension  = '-w' . $width;

        }

        $name       = File::name($imagePath);
        $directory  = File::dirname($imagePath);
        $extension  = File::extension($imagePath);

        $resizedImage = $directory . '/' . $name . $sizeExtension . '.' . $extension;

        if(!File::exists($resizedImage)) {
            Image::read($imagePath)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($resizedImage);
        }

        return $resizedImage;
    }
}