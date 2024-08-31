<?php

namespace App\Services;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostService
{

    public function create_post($request)
    {
        $post = new Post;
        $post->title = ucwords($request->title);
        $post->content = $request->content;
        $post->author = ucwords($request->author);
        $post->category = $request->category;
        $post->slug = Str::slug(uniqid() . '-' . $request->title, '-');
        $post->published = false;
        $post->identifier = uniqid('BID-') . '-Z';
        $post->poster_id = auth()->id();
        $post->save();
        return $post;
    }


    public function get_post($slug)
    {
        return Post::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['is_main', 'filename', 'post_id']);
        }])
            ->where('slug', $slug)
            ->select([
                'id', 'title', 'content', 'author', 'category',
                'created_at', 'slug', 'identifier'
            ])->firstOrFail();
    }


    public function get_all_posts()
    {
        return Post::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'post_id']);
        }])
            ->where('published', true)
            ->select([
                'id', 'title', 'content', 'author', 'category',
                'created_at', 'slug'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }


    public function sideposts()
    {
        $posts = $this->get_all_posts();
        return count($posts) > 3 ? $posts->random(3) : collect([]);
    }


    public function update_post($request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->title != ucwords($request->title)) {
            $post->title = ucwords($request->title);
            $post->slug = Str::slug(uniqid() . '-' . $request->title, '-');
        }
        $post->content = $request->content;
        $post->author = ucwords($request->author);
        $post->category = $request->category;
        $post->save();
        return $post;
    }


    public function posts_admin()
    {
        // return Post::select([
        //     'id', 'title', 'content', 'category',
        //     'created_at', 'slug', 'published'
        // ])
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);
        return Post::leftjoin('page_visits', 'posts.identifier', '=', 'page_identifier')
            ->groupBy('posts.id')
            ->select([
                'posts.id', 'posts.title', 'posts.author', 'posts.category',
                'posts.created_at', 'posts.slug', 'posts.published',
                DB::raw('COUNT(page_visits.id) AS visits_count')
            ])
            ->orderBy('posts.updated_at', 'desc')
            ->paginate(10);

        // $query = Post::leftjoin('page_visits', 'posts.identifier', '=', 'page_identifier')
        //     ->groupBy('posts.id');

        // try {
        //     return $query->select([
        //         'posts.id', 'posts.title', 'posts.category',
        //         'posts.created_at', 'posts.slug', 'posts.published',
        //         DB::raw('COUNT("page_visits"."id") AS "visits_count"')
        //     ])->paginate(10);
        // } catch (QueryException $th) {
        //     return $query->select([
        //             'posts.id', 'posts.title', 'posts.category',
        //             'posts.created_at', 'posts.slug', 'posts.published',
        //             DB::raw('COUNT(page_visits.id) AS visits_count')
        //         ])->paginate(10);
        // }
    }
}
