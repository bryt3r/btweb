<?php

namespace App\Http\Controllers;

use App\Events\PageViewedEvent;
use App\Http\Traits\ImageUploadTraits;
use App\Models\Category;
use App\Models\Project;
use App\Services\ProjectImageService;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{

    use ImageUploadTraits;

    public function __construct(
        protected ProjectService $projectservice,
        protected ProjectImageService $projectimageservice
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_identifier = 'projects';
        $projects = $this->projectservice->get_all_projects();
        event(new PageViewedEvent($request, $page_identifier));
        $data = [
            'page_title' => 'BETA TECHNICIANS - PROJECTS',
            'projects' => $projects,
        ];
        // return $projects;
        return view('projects.index')->with($data);
    }


    public function projects_manage()
    {
        $projects = $this->projectservice->projects_admin();
        $page_title = 'MANAGE PROJECTS';
        return view('projects.manage')->with(['projects' => $projects, 'page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        $categories = Category::where('section', 'projects')->get(['name']);
        $data = [
            'categories' => $categories,
            'page_title' => 'CREATE POST',
        ];
        return view('projects.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_preview(Request $request)
    {
        $this->authorize('create', Project::class);
        $request->validate([
            'title' =>  ['required', 'string',],
            'details' =>  ['required', 'string',],
            'category' =>  ['required', 'string',],
            'location' =>  ['required', 'string',],
            'date' =>  ['required'],
            'imageFile.*' => ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
        ]);
        $project = $this->projectservice->create_project($request);
        // return $project;
        $image_exists = false;

        if ($request->file('imageFile')) {
            $files = $request->file('imageFile');
            $path = 'project_images';

            foreach ($files as $key => $file) {
                $uploaded_filename = $this->uploadProjectImageWithWatermark($file, $key, $path);
                $this->projectimageservice->save_project_image($image_exists, $key, $uploaded_filename, $project);
            }
        }
        // $project = $this->projectservice->get_project($project->slug);

        return view('projects.preview')->with(['project' => $project]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $project = $this->projectservice->get_project($slug);
        $page_title = $project->title;
        $page_image = asset('uploads/project_images').'/'.($project->images ? $project->images[0]->filename??'default.jpg':'');
        $data = [
            'project' => $project,
            'page_title' => $page_title,
            'page_description' => $page_title,
            'page_image' => $page_image,
        ];
        event(new PageViewedEvent($request, $project->identifier));
        return view('projects.project')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $this->authorize('update', $project);
        $categories = Category::where('section', 'projects')->get(['name']);
        $page_title = 'EDIT PROJECT';
        $data = [
            'project' => $project,
            'page_title' => $page_title,
            'categories' => $categories
        ];
        return view('projects.create')->with($data);
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
        $this->authorize('update', Project::findOrFail($id));
        $request->validate([
            'title' =>  ['required', 'string',],
            'details' =>  ['required', 'string',],
            'category' =>  ['required', 'string',],
            'location' =>  ['required', 'string',],
            'date' =>  ['required'],
            'imageFile.*' => ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
        ]);
        $project = $this->projectservice->update_project($request, $id);
        $image_exists = isset($project->images[0]) ? true : false;

        if ($request->file('imageFile')) {
            $files = $request->file('imageFile');
            $path = 'project_images';

            foreach ($files as $key => $file) {
                $uploaded_filename = $this->uploadProjectImageWithWatermark($file, $key, $path);
                $this->projectimageservice->save_project_image($image_exists, $key, $uploaded_filename, $project);
            }
        }
        return redirect()->route('projects.manage')->with('success', 'UPDATED SUCCESSFULLY');
    }


    public function publish(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $this->authorize('publish', $project);

        $project->published = !$project->published;
        $project->save();
        $action = $project->published ? 'PUBLISHED' : 'UNPUBLISHED';
        return redirect()->route('projects.manage')->with('success', $action . ' SUCCESSFULLY');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::with('images')
            ->where('id', $id)->first();

        $image_exists = isset($project->images) ?? null;
        $this->authorize('delete', $project);
        $project->delete();
        if ($image_exists) {
            foreach ($project->images as $image) {
                $filename = $image->filename;
                $path = storage_path('app/uploads/project_images/') . $filename;
                if (App::environment(['production'])) {
                    $path = base_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public_html/uploads/project_images/' . $filename;

                }
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }

        return redirect()->route('projects.manage')->with('success', 'DELETED SUCCESSFULLY');
    }
}
