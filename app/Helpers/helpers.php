<?php

use Illuminate\Support\Str;

if (! function_exists('unlink_image_names')) {
    /**
     * unlinks named images from storage
     */
    function unlink_image_names(array $array)
    {
        foreach ($array as $key => $existing_image_path) {
            $result = $existing_image_path != null ? unlink(public_path('storage/images/').$existing_image_path) : null;
        }
    }
}

if (! function_exists('seperate_thumbnail_image_name_and_remove')) {
    /**
     * seperates thumbnail image name and then unlinks from storage
     */
    function seperate_thumbnail_image_name_and_remove($ImageName)
    {
        $stored_image_name = Str::after($ImageName, 'http://localhost:8000/storage/product_thumbnails/');
        unlink(public_path('storage/product_thumbnails/').$stored_image_name);
    }
}

if (! function_exists('seperate_image_name_and_remove')) {
    /**
     * seperates image name and then unlinks from storage
     */
    function seperate_image_name_and_remove($ImageName)
    {
        $stored_image_name = Str::after($ImageName, 'http://localhost:8000/storage/images/');
        unlink(public_path('storage/images/').$stored_image_name);
    }
}

if (! function_exists('getVariableName')) {
    function getVariableName($value)
    {
        foreach (get_defined_vars() as $varName => $varValue) {
            if ($varValue === $value) {
                return $varName;
            }
        }

        return null; // If the variable name is not found
    }
}
