<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageVisitController extends Controller
{
    public function index()
    {
        $visits = PageVisit::select([
            'page_identifier', 'id', 'url',
            DB::raw('COUNT(id) AS views_count')
        ])
            ->groupBy('page_identifier')
            ->orderBy('views_count', 'desc')
            ->paginate(30);

        $products = Product::get(['identifier', 'title'])
            ->mapWithKeys(function ($item, $key) {
                return [
                    $item['identifier'] => [
                        'title' => $item['title'],
                        'type' => 'product',
                    ]
                ];
            });
        $posts = Post::get(['identifier', 'title'])
            ->mapWithKeys(function ($item, $key) {
                return [
                    $item['identifier'] => [
                        'title' => $item['title'],
                        'type' => 'post',
                    ]
                ];
            });
        $products = count($products) > 0 ? $products : collect([]);
        $posts = count($posts) > 0 ? $posts : collect([]);
        $titles = $products->merge($posts)->toArray();
        // dd($titles);
        $data = [
            'titles' => $titles,
            'visits' => $visits
        ];
        return view('page_visits.index')->with($data);
    }


    public function visits_all()
    {
        $visits = PageVisit::select([
            'username',
            'device_info',
            'url',
            'browser',
            'user_ip',
            'user_state',
            'user_country',
            'created_at',
            'user_agent',
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $data = [
            'visits' => $visits,
            'identifier' => 'All',
        ];
        return view('page_visits.list')->with($data);
    }


    public function show_list($identifier)
    {
        $visits = PageVisit::where('page_identifier', $identifier)
            ->select([
                'username',
                'device_info',
                'url',
                'browser',
                'user_ip',
                'user_state',
                'user_country',
                'created_at',
                'user_agent',
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $data = [
            'visits' => $visits,
            'identifier' => $identifier,
        ];

        return view('page_visits.list')->with($data);
    }
}
