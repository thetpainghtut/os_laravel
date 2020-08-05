<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Brand;
use Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        // dd($items);
        return view('backend.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required',
        ]);

        // File Upload
        $imageName = time().'.'.$request->photo->extension();

        $request->photo->move(public_path('backendtemplate/brandimg'),$imageName);
        $myfile = 'backendtemplate/brandimg/'.$imageName;

        // Store Data
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->photo = $myfile;

        $brand->save();

        // Redirect
        Alert::success('Success!', 'New Brand Inserted Successfully.');

        return redirect()->route('brands.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.brands.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        // dd($item);
        return view('backend.brands.edit',compact('brand'));
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
            
            'name' => 'required',
            // 'photo' => 'required',
            // may be present or absent

        ]);

        

        // File Upload
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();

            $request->photo->move(public_path('backendtemplate/brandimg'),$imageName);
            $myfile = 'backendtemplate/brandimg/'.$imageName;
        }

        // if upload new image, delete old image;
        
        

        // Update Data
        $brand = Brand::find($id);
        // dd($category);
        $brand->name = $request->name;
        if ($request->hasFile('photo')) {
                File::delete($brand->photo);
                $brand->photo = $myfile;  
            }else{
                $brand->photo = $brand->photo;
            }

        $brand->save();

        // Redirect
        Alert::success('Success!', 'Brand Updated Successfully.');

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        $brand->delete();

        Alert::success('Success!', 'Brand Deleted Successfully.');
        
        return redirect()->route('brands.index');
    }
}
