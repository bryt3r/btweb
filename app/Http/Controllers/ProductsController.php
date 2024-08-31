<?php

namespace App\Http\Controllers;

use App\Events\PageViewedEvent;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Traits\ImageUploadTraits;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ProductImageService;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    use ImageUploadTraits;

    public function __construct(
        protected ProductService $productservice,
        protected ProductImageService $productimageservice
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_identifier = 'shop-home';
        event(new PageViewedEvent($request, $page_identifier));
        return view('products.index');
    }


    public function product_search(Request $request)
    {
        $value = $request->get('search');
        $results = $this->productservice->search($value);
        $data = [
            'products' => $results,
            'category' => 'Showing results for \'' . $value . '\'', 'results' => $results
        ];
        return view('products.products')->with($data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_category($category)
    {
        $products = $this->productservice->show_category_products($category);
        $brands = Brand::where('device_type', $category)->get(['name']);
        $data = [
            'brands' => $brands,
            'category' => strtoupper($category),
            'products' => $products
        ];
        return view('products.products')->with($data);
    }


    public function generate_list(Request $request)
    {
        $this->authorize('create', Product::class);
        $category = $request->category;
        $products = $this->productservice->show_category_products($category);
        $date = Carbon::now()->isoFormat('D MMM, Y');
        $data = [
            'date' => $date,
            'category' => strtoupper($category),
            'products' => $products
        ];
        return view('products.textview')->with($data);
    }


    public function filter_brand(Request $request)
    {
        $request->validate([
            'brand' => ['required', 'string'],
            'category' => ['required', 'string'],
        ]);

        $brand_filter = $request->get('brand');
        $category = strtolower($request->get('category'));
        $products = $this->productservice->filter_category_brand($category, $brand_filter);
        $brands = Brand::where('device_type', $category)->get(['name']);
        $data = [
            'brands' => $brands,
            'brand_filter' => $brand_filter,
            'category' => strtoupper($category),
            'products' => $products
        ];
        return view('products.products')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Product::class);
        $category = $request->category;
        $brands = Brand::where('device_type', $category)->get(['name']);
        $data = [
            'brands' => $brands,
            'category' => $category
        ];
        //do checks for brands availability too
        if (!$category) {
            return redirect()->route('products.manage')->with('error', 'Please Select A Category');
        } 
        if (!isset($brands) or empty($brands)) {
            return redirect()->route('products.manage')->with('error', 'Please Create Brands');
        } 
        return view('products.create')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);
        $product = $this->productservice->create_product($request);

        if ($request->file('imageFile')) {

            $files = $request->file('imageFile');
            $path = 'product_images';
            $image_exists = false;

            foreach ($files as $key => $file) {
                $uploaded_filename = $this->uploadProductImageWithWatermark($file, $key, $path);
                $this->productimageservice->save_product_image($image_exists, $key, $uploaded_filename, $product);
            }
        }
        return redirect()->route('products.manage')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $product = $this->productservice->get_slug_product($slug);
        $page_title = $product->title;
        $page_image = asset('uploads/product_images').'/'.($product->images ? $product->images[0]->filename??'default.jpg':'');
        $data = [
            'product' => $product,
            'page_title' => $page_title,
            'page_description' => $page_title,
            'page_image' => $page_image,
        ];
        event(new PageViewedEvent($request, $product->identifier));
        return view('products.product_page')->with($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_show($identifier)
    {
        $product = $this->productservice->get_identifier_product($identifier);
        $page_title = $product->title;
        $page_image = asset('uploads/product_images').'/'.($product->images ? $product->images[0]->filename??'default.jpg':'');
        $data = [
            'product' => $product,
            'page_title' => $page_title,
            'page_description' => $page_title,
            'page_image' => $page_image,
        ];
        return view('products.product_page')->with($data);
    }


    public function products_manage()
    {
        $products = $this->productservice->get_admin_products();
        $categories = Category::where('section', 'products')->get(['name']);
        $data = [
            'categories' => $categories,
            'products' => $products
        ];
        return view('products.manage')->with($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productservice->get_id_product($id);
        $this->authorize('update', $product);
        $brands = Brand::where('device_type', $product->category)->get(['name']);
        $categories = Category::where('section', 'products')->get(['name']);
        $data = [
            'brands' => $brands,
            'categories' => $categories,
            'product' => $product
        ];

        return view('products.create')->with($data);
    }


    public function set_price(Request $request, $id)
    {
        $this->authorize('set_price', Product::findOrFail($id));
        $bag = 'form' . $id;
        $request->validateWithBag(
            $bag,
            [
                'cost_price' => ['required', 'numeric', 'min:0'],
                'selling_price' => ['required', 'numeric', 'min:0'],
                'sale_price' => ['nullable', 'numeric', 'lte:selling_price', 'min:0'],
            ]
        );

        $this->productservice->update_price($request, $id);
        return back()->with('success', 'UPDATED SUCCESSFULLY');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->authorize('update', Product::findOrFail($id));
        $product = $this->productservice->update_product($request, $id);
        $image_exists = isset($product->images[0]) ? true : false;

        if ($request->file('imageFile')) {
            $files = $request->file('imageFile');
            $path = 'product_images';

            foreach ($files as $key => $file) {
                $uploaded_filename = $this->uploadProductImageWithWatermark($file, $key, $path);
                $this->productimageservice->save_product_image($image_exists, $key, $uploaded_filename, $product);
               
            }
        }
        return back()->with('success', 'UPDATED SUCCESSFULLY');
    }

    public function mark_listed($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('list', $product);
        $product->is_listed = !$product->is_listed;
        $product->save();
        $action = $product->is_listed ? 'Listed' : 'Unlisted';
        return redirect()->route('products.manage')->with('success', $action . ' SUCCESSFULL');
    }


    public function mark_sold($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('sold', $product);
        $product->is_sold =  !$product->is_sold;
        $product->is_listed = $product->is_sold ? false : true;
        $product->save();
        $action = $product->is_sold ? 'SOLD & UNLISTED' : 'UNSOLD';
        return redirect()->route('products.manage')->with('success', $action . ' SUCCESSFULL');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::with('images')
            ->where('id', $id)->first();

        $image_exists = isset($product->images) ?? null;
        $this->authorize('delete', $product);
        $product->delete();
        if ($image_exists) {
            foreach ($product->images as $image) {
                $filename = $image->filename;
                $path = storage_path('app/uploads/product_images/') . $filename;
                if (App::environment(['production'])) {
                    $path = base_path() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public_html/uploads/product_images/' . $filename;

                    // $path = asset('uploads/product_images/'). $filename;
                }
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }

        return redirect()->route('products.manage')->with('success', 'DELETED SUCCESSFULLY');
    }
}
