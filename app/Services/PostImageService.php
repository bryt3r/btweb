<?php
namespace App\Services;

use App\Models\PostImage;
use Illuminate\Http\Request;

class PostImageService
{

    public function save_post_image($image_exists, $key, $uploaded_filename, $post)
    {
       $post_image = new PostImage();
        $post_image->filename = $uploaded_filename;
        if (!$image_exists) {
            $post_image->is_main = $key == 0 ? true : false;
        } else {
            $post_image->is_main = false;
        }
        $post_image->post_id = $post->id;
        $post_image->save();
    }
}
