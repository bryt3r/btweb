<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageUploadTraits;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class ProjectImageController extends Controller
{
    use ImageUploadTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function mark_main($id)
    {
        $new_main = ProjectImage::findOrFail($id);
        $this->authorize('update', $new_main);
        $old_main = ProjectImage::where('project_id', $new_main->project_id)
        ->where('is_main', true)
        ->first();

        $this->markAsMain($old_main, $new_main);

        return redirect()->route('project.edit', ['id' => $new_main->project_id])->with('success', 'Marked As Main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ProjectImage::findOrFail($id);
        $this->authorize('delete', $image);
        
        $path = storage_path('app/uploads/project_images/') . $image->filename;
        if (App::environment(['production'])) {
            $path = base_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public_html/uploads/project_images/' . $image->filename;
            // $path = asset('uploads/project_images/'). $image->filename;
        }
        $image->delete();
        if (!File::exists($path)) {
            return redirect()->route('project.edit', ['id' => $image->project_id])->with('error', 'Image Not Found, Link Removed');
        }
        
        File::delete($path);

        if ($image->is_main) {
            $main_image = ProjectImage::where('project_id', $image->project_id)->first();
            if ($main_image) {
                $main_image->is_main = true;
                $main_image->save();
            }
        }
        return redirect()->route('project.edit', ['id' => $image->project_id])->with('success', 'Image Delete Successful');
    
    }
}
