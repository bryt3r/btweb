<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait ImageUploadTraits
{

    public function uploadProductImageWithWatermark($file, $key, $path)
    {
        return $this->uploadImageWithWatermark($file, $key, $path);
    }


    public function uploadProjectImageWithWatermark($file, $key, $path)
    {
        return $this->uploadImageWithWatermark($file, $key, $path);
    }


    public function uploadPostImage($file, $key, $path)
    {
        $img = Image::make($file)
            ->resize(640, 640, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        // ->insert($watermark, 'center', 0, -50);
        $uploaded_filename = time() . '_' . $key . '_' . $file->getClientOriginalName();
        // TODO check and purge filename for special characters or just use random strings.time instead
        $uploaded_filename = str_replace(" ", "_", $uploaded_filename);

        $this->environment_save($img, $path, $uploaded_filename);

        return $uploaded_filename;
    }


    public function markAsMain($old_main, $new_main)
    {
        if ($old_main) {
            $old_main->is_main = false;
            $old_main->save();
        }

        $new_main->is_main = true;
        $new_main->save();
    }


    private function uploadImageWithWatermark($file, $key, $path)
    {
        $watermark = storage_path('app/uploads/watermark/watermark.png');
        $img = Image::make($file)
            ->resize(640, 640, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->insert($watermark, 'center', 0, -50);
        $uploaded_filename = time() . '_' . $key . '_' . $file->getClientOriginalName();
        // TODO check and purge filename for special characters or just use random strings.time instead
        $uploaded_filename = str_replace(" ", "_", $uploaded_filename);

        $this->environment_save($img, $path, $uploaded_filename);

        return $uploaded_filename;
    }


    private function environment_save($img, $path, $uploaded_filename)
    {
        if (App::environment(['production'])) {
            $directory = base_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public_html/uploads/' . $path;
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }
            $img->save($directory . '/' . $uploaded_filename);
        } else {
            $img->save(storage_path('app/uploads/' . $path) . '/' . $uploaded_filename);
        }
    }
}
