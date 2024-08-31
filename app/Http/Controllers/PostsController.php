<?php

namespace App\Http\Controllers;

use App\Events\PageViewedEvent;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Traits\ImageUploadTraits;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\PostImageService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

use function GuzzleHttp\Promise\all;

class PostsController extends Controller
{
    use ImageUploadTraits;

    public function __construct(
        protected PostService $postservice,
        protected PostImageService $postimageservice
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_identifier = 'blog-home';
        $posts = $this->postservice->get_all_posts();
        $sideposts = $this->postservice->sideposts();
        event(new PageViewedEvent($request, $page_identifier));
        $data = [
            'page_title' => 'BETA TECHNICIANS - BLOG',
            'page_description' => 'Welcome to Beta Technicians blog',
            'page_image' => '',
            'posts' => $posts,
            'sideposts' => $sideposts
        ];
        return view('posts.index')->with($data);
    }



    public function blog_manage()
    {
        $posts = $this->postservice->posts_admin();
        $page_title = 'MANAGE POSTS';
        return view('posts.manage')->with(['posts' => $posts, 'page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categories = Category::where('section', 'posts')->get(['name']);
        $data = [
            'categories' => $categories,
            'page_title' => 'CREATE POST',
        ];
        return view('posts.create')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_preview(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);
        $post = $this->postservice->create_post($request);
        $image_exists = false;

        if ($request->file('imageFile')) {
            $files = $request->file('imageFile');
            $path = 'post_images';
            foreach ($files as $key => $file) {
                $uploaded_filename = $this->uploadPostImage($file, $key, $path);
                $this->postimageservice->save_post_image($image_exists, $key, $uploaded_filename, $post);
            }
        }
        $post = $this->postservice->get_post($post->slug);

        return view('posts.preview')->with(['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $post = $this->postservice->get_post($slug);
        $sideposts = $this->postservice->sideposts();
        $page_image = asset('uploads/post_images').'/'.($post->images ? $post->images[0]->filename??'default.jpg':'');
        $data = [
            'post' => $post,
            'sideposts' => $sideposts,
            'page_title' => $post->title,
            'page_description' => Str::limit($post->content, '150'),
            'page_image' => $page_image,
        ];
        //    return $post;
        event(new PageViewedEvent($request, $post->identifier));
        return view('posts.post')->with($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        $categories = Category::where('section', 'posts')->get(['name']);
        $page_title = 'EDIT POST';
        $data = ['post' => $post, 'page_title' => $page_title, 'categories' => $categories];
        return view('posts.create')->with($data);
    }


    public function publish(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('publish', $post);
        // $request->validate(['publish' => ['required', 'string'],]);

        $post->published = !$post->published;
        $post->save();
        $action = $post->published ? 'PUBLISHED' : 'UNPUBLISHED';
        return redirect()->route('posts.manage')->with('success', $action . ' SUCCESSFULLY');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $this->authorize('update', Post::findOrFail($id));
        $post = $this->postservice->update_post($request, $id);
        $image_exists = isset($post->images[0]) ? true : false;

        if ($request->file('imageFile')) {
            $files = $request->file('imageFile');
            $path = 'post_images';

            foreach ($files as $key => $file) {
                $uploaded_filename = $this->uploadPostImage($file, $key, $path);
                $this->postimageservice->save_post_image($image_exists, $key, $uploaded_filename, $post);
            }
        }
        $post = $this->postservice->get_post($post->slug);
        $page_title = 'PREVIEW POST';
        return view('posts.preview')->with(['post' => $post, 'page_title' => $page_title]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::with('images')
            ->where('id', $id)->first();

        $this->authorize('delete', $post);

        $image_exists = isset($post->images) ?? null;
        $post->delete();
        if ($image_exists) {
            foreach ($post->images as $image) {
                $filename = $image->filename;
                $path = storage_path('app/uploads/post_images/') . $filename;
                if (App::environment(['production'])) {
                    $path = base_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public_html/uploads/post_images/' . $filename;

                }
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            return redirect()->route('posts.manage')->with('success', 'DELETED SUCCESSFULLY');
        }
    }
}
