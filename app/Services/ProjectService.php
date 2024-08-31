<?php

namespace App\Services;

use App\Http\Requests\StoreprojectRequest;
use App\Models\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProjectService
{

    public function create_project($request)
    {
        $project = new Project;
        $project->title = ucwords($request->title);
        $project->details = $request->details;
        $project->category = $request->category;
        $project->location = $request->location;
        $project->date = $request->date;
        $project->slug = Str::slug(uniqid() . '-' . $request->title, '-');
        $project->published = false;
        $project->identifier = uniqid('PJID-') . '-Z';
        $project->author_id = auth()->id();
        $project->save();
        return $project;
    }


    public function get_project($slug)
    {
        return Project::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['is_main', 'filename', 'project_id']);
        }])
            ->where('slug', $slug)
            ->where('published', true)
            ->select([
                'id', 'title', 'details', 'category',
                'location', 'date', 'slug', 'identifier'
            ])->firstOrFail();
    }


    public function get_all_projects()
    {
        return Project::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'project_id']);
        }])
            ->where('published', true)
            ->orderBy('date', 'desc')
            ->select([
                'id', 'title', 'details', 'category',
                'location', 'date', 'slug', 'identifier'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    }


    public function update_project($request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->title != ucwords($request->title)) {
            $project->title = ucwords($request->title);
            $project->slug = Str::slug(uniqid() . '-' . $request->title, '-');
        }
        $project->details = $request->details;
        $project->category = $request->category;
        $project->location = $request->location;
        $project->date = $request->date;
        $project->save();
        return $project;
    }


    public function projects_admin()
    {
        // return Project::select([
        //     'id', 'title', 'details', 'category',
        // 'location', 'date', 'slug', 'identifier'
        // ])
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);
        return Project::leftjoin('page_visits', 'projects.identifier', '=', 'page_identifier')
            ->groupBy('projects.id')
            ->orderBy('projects.date', 'desc')
            ->select([
                'projects.id', 'projects.title', 'projects.category',
                'projects.details', 'projects.slug', 'projects.published', 'projects.date',
                DB::raw('COUNT(page_visits.id) AS visits_count')
            ])->paginate(10);

    
    }
}
