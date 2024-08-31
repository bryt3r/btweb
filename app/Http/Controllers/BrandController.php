<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        // return $brands;
        return view('brands.manage')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Brand::class);
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Brand::class);
        $request->validate([
            'name' =>  ['required', 'string',],
            'device_type' =>  ['required', 'string',]
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->device_type = $request->device_type;
        $brand->save();

        return redirect()->route('brands')->with('success', 'New Brand Added');

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
        $brand = Brand::findOrFail($id);
        $this->authorize('update', $brand);
        return view('brands.create')->with(['brand' => $brand]);
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
        $request->validate([
            'name' =>  ['required', 'string',],
            'device_type' =>  ['required', 'string',]
        ]);

        $brand = Brand::findOrFail($id);
        $this->authorize('update', $brand);
       
        $brand->name = $request->name;
        $brand->device_type = $request->device_type;
        $brand->save();

        return redirect()->route('brands')->with('success', 'Update Successful');
    }

    // public function delete_image($id)
    // {
    //     # code...
    // }


    // public function delete_icon($id)
    // {
    //     # code...
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Brand::class);
        Brand::destroy($id);
        return redirect()->route('brands')->with('success', 'Delete Successful');
    }
}
