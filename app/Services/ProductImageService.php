<?php

namespace App\Services;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageService
{

    public function save_product_image($image_exists, $key, $uploaded_filename, $product)
    {
        $product_image = new ProductImage();
        $product_image->filename = $uploaded_filename;
        if (!$image_exists) {
            $product_image->is_main = ($key == 0) ? true : false;
        } else {
            $product_image->is_main = false;
        }
        $product_image->product_id = $product->id;
        $product_image->save();
    }
}
