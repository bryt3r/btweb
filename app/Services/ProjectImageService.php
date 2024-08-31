<?php
namespace App\Services;

use App\Models\ProjectImage;
use Illuminate\Http\Request;

class ProjectImageService
{

    public function save_project_image($image_exists, $key, $uploaded_filename, $project)
    {
       $project_image = new ProjectImage();
        $project_image->filename = $uploaded_filename;
        if (!$image_exists) {
            $project_image->is_main = $key == 0 ? true : false;
        } else {
            $project_image->is_main = false;
        }
        $project_image->project_id = $project->id;
        $project_image->save();
    }
}
