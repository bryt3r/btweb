<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PostImagePolicy;
use App\Policies\PostPolicy;
use App\Policies\ProductImagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProjectImagePolicy;
use App\Policies\ProjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Brand::class => BrandPolicy::class,
        Category::class => CategoryPolicy::class,
        Post::class => PostPolicy::class,
        PostImage::class => PostImagePolicy::class,
        Product::class => ProductPolicy::class,
        ProductImage::class => ProductImagePolicy::class,
        Project::class => ProjectPolicy::class,
        ProjectImage::class => ProjectImagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
