<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Brands';
        $acc_id = Session::get('acc_id');
        $data['brands'] = Brand::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'acc_id' => 'required',
            'brand_title' => 'required | unique:brands',
            'brand_status' => 'required',
        ], [
            'brand_title.unique' => 'Title Should be unique',
            'brand_title.required' => 'Title is required',
            'brand_status.required' => 'Status is required',
            'acc_id.required' => 'Account is required',

        ]);
        $info = array(
        'acc_id' => $request->input('acc_id'),
        'brand_title' => $request->input('brand_title'),
        'brand_status' => $request->input('brand_status')
        );
        Brand::create($info);
        return redirect(route('brand.index'))->with('message','Brand has been Added');
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
        if(empty( trim($id) ) or !is_numeric( $id )){
            return redirect(route('brand.index'));
        }
        $data['title'] = 'Edit Brand';
        $data['brand']  = Brand::where('brand_id','=',$id)->first();
        
        return view('brand.update', $data);
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
        $validatedData = $request->validate([
            'acc_id' => 'required',
            'brand_title' => 'required',
            'brand_status' => 'required',
        ], [
            'acc_id.required' => 'Account is required',
            'brand_title.required' => 'Title is required',
            'brand_status.required' => 'Status is required'
        ]);
        Brand::where('brand_id','=',$id)->update([
        'acc_id' => $request->input('acc_id'),
        'brand_title' => $request->input('brand_title'),
        'brand_status' => $request->input('brand_status')
        ]);
        return redirect(route('brand.index'))->with('message','Brand has been  update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::where('brand_id','=',$id)->delete();
        return redirect(route('brand.index'))->with('message','Brand has been  Deleted successfull');
    }
}