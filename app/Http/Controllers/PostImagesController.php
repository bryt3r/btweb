<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageUploadTraits;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class PostImagesController extends Controller
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


    public function image_upload(Request $request)
    {
        $this->authorize('create', PostImage::class);
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = 'post_images/';
            $key = 'ck';
            $fileName = $this->uploadPostImage($file, $key, $path);
            $url = asset('uploads/post_images/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }


    public function mark_main($id)
    {
        $new_main = PostImage::findOrFail($id);
        $this->authorize('update', $new_main);
        $old_main = PostImage::where('post_id', $new_main->post_id)
            ->where('is_main', true)
            ->first();

        $this->markAsMain($old_main, $new_main);

        return redirect('/blog_edit/' . $new_main->post_id)->with('success', 'Marked As Main');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $image = PostImage::findOrFail($id);
        $this->authorize('delete', $image);

        $path = storage_path('app/uploads/post_images/') . $image->filename;

        if (App::environment(['production'])) {
            $path = base_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public_html/uploads/post_images/' . $image->filename;

        }

        $image->delete();
        if (!File::exists($path)) {
            return redirect()->route('post.edit', ['id' => $image->post_id])->with('error', 'Image Not Found, Link Removed');
        }

        File::delete($path);

        if ($image->is_main) {
            $main_image = PostImage::where('post_id', $image->post_id)->first();
            if ($main_image) {
                $main_image->is_main = true;
                $main_image->save();
            }
        }
        return redirect()->route('post.edit', ['id' => $image->post_id])->with('success', 'Image Delete Successful');
    }
}
