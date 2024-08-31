<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{

    public function create_product($request)
    {
        $product = new Product();
        $product->title = ucwords($request->title);
        $product->slug = Str::slug(uniqid() . '-' . $request->title, '-');
        $product->identifier = uniqid('PID-') . '-Z';
        $product->condition = $request->condition;
        $product->category = strtolower($request->category);
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->price_set = $request->selling_price > 1 ? true : false;
        $product->is_listed = false;
        $product->is_sold = false;
        $product->discounted = false;
        $product->discount = 0;
        $product->costprice = $request->cost_price;
        $product->sellingprice = $request->selling_price;
        $product->saleprice = 0;
        $product->lister_id = auth()->id();
        $product->save();

        return $product;
    }


    public function get_id_product($id)
    {
        return Product::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['id', 'filename', 'product_id', 'is_main']);
        }])
            ->where('id', $id)
            ->select([
                'id', 'title', 'description', 'category', 'slug',
                'brand', 'condition', 'sellingprice', 'costprice'
            ])
            ->first();
    }


    public function get_slug_product($slug)
    {
        return Product::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'is_main', 'product_id']);
        }])
            ->where('is_listed', true)
            ->where('slug', $slug)->select([
                'id', 'title', 'condition', 'category',
                'description', 'sellingprice', 'saleprice',
                'discount', 'discounted', 'identifier',
            ])
            ->firstOrFail();
    }


    public function get_identifier_product($identifier)
    {
        return Product::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'is_main', 'product_id']);
        }])
            ->where('is_listed', true)
            ->where('identifier', $identifier)->select([
                'id', 'title', 'condition', 'category', 'description', 'costprice',
                'sellingprice', 'saleprice', 'discount', 'discounted', 'identifier',
            ])
            ->firstOrFail();
    }


    public function get_all_products($slug)
    {
        # code...
    }


    public function get_admin_products()
    {
        return Product::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'product_id']);
        }])
            ->leftjoin('page_visits', 'products.identifier', '=', 'page_identifier')
            ->groupBy('products.id')
            ->orderBy('products.created_at', 'desc')
            ->select([
                'products.id', 'products.title', 'products.category',
                'products.condition', 'products.slug', 'products.description',
                'products.costprice', 'products.sellingprice', 'products.saleprice',
                'products.is_listed', 'products.is_sold', 'products.discount', 'products.discounted',
                DB::raw('COUNT(page_visits.id) AS visits_count')
            ])->paginate(10);
    }


    public function update_product($request, $id)
    {
        $product = $this->get_id_product($id);

        if ($product->title != ucwords($request->title)) {
            $product->title = ucwords($request->title);
            $product->slug = Str::slug(uniqid() . '-' . $request->title, '-');
        }
        $product->condition = $request->condition;
        $product->category = strtolower($request->category);
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->costprice = $request->cost_price;
        $product->save();

        return $product;
    }


    public function update_price($request, $id)
    {
        $product = Product::findOrFail($id);
        $discounted = null;
        $discount = 0;
        if ($request->sale_price > 0 and $request->selling_price > $request->sale_price) {
            $discount = ($request->selling_price - $request->sale_price) / $request->selling_price;
            $discounted = true;
        } else {
            $discounted = false;
        }

        $product->costprice = $request->cost_price;
        $product->sellingprice = $request->selling_price;
        $product->saleprice = $request->sale_price;
        $product->discount = $discount;
        $product->discounted = $discounted;
        $product->save();
    }


    public function search($value)
    {
        return Product::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'product_id']);
        }])
            ->where('title', 'LIKE', '%' . $value . '%')
            ->where('is_listed', true)
            ->select([
                'id', 'title', 'description', 'brand', 'category', 'condition',
                'sellingprice', 'saleprice', 'discount', 'discounted', 'slug'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }


    public function show_category_products($category)
    {
        //do a check to confirm category is available!!
        $categories = ['all', 'phone', 'computer', 'accessory'];
        if (!in_array($category, $categories)) {
            return collect([]);
        }
        $categories_array = ($category == 'all') ? ['phone', 'computer', 'accessory'] : [$category];

        return Product::with(['images' => function ($query) {
            $query->orderBy('is_main', 'desc');
            $query->select(['filename', 'product_id']);
        }])
            ->whereIn('category', $categories_array)
            ->where('is_listed', true)
            ->select([
                'id', 'title', 'description', 'brand', 'category', 'condition',
                'sellingprice', 'saleprice', 'discount', 'discounted', 'slug'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }


    public function filter_category_brand($category, $brand)
    {
        return Product::with(['images' => function ($query) {
            $query->select(['filename', 'product_id']);
        }])
            ->where('category', $category)
            ->where('is_listed', true)
            ->where('brand', $brand)
            ->select([
                'id', 'title', 'description', 'brand', 'category', 'condition',
                'sellingprice', 'saleprice', 'discount', 'discounted', 'slug'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
