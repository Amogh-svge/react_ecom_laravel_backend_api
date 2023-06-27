<?php

use Illuminate\Support\Str;

// unlinks named images from storage
if (!function_exists('unlink_image_names')) {
    function unlink_image_names(array $array)
    {
        foreach ($array as $key => $existing_image_path) {
            $result = $existing_image_path != null ? unlink(public_path('storage/images/') .  $existing_image_path) : null;
        }
    }
}

// seperates thumbnail image name and then unlinks from storage
if (!function_exists('seperate_thumbnail_image_name_and_remove')) {
    function seperate_thumbnail_image_name_and_remove($ImageName)
    {
        $stored_image_name = Str::after($ImageName, "http://localhost:8000/storage/product_thumbnails/");
        unlink(public_path('storage/product_thumbnails/') . $stored_image_name);
    }
}

// seperates image name and then unlinks from storage
if (!function_exists('seperate_image_name_and_remove')) {
    function seperate_image_name_and_remove($ImageName)
    {
        $stored_image_name = Str::after($ImageName, "http://localhost:8000/storage/images/");
        unlink(public_path('storage/images/') . $stored_image_name);
    }
}
