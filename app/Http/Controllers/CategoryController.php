<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Categories';
        // $data['categories'] = Category::all();
        $acc_id = Session::get('acc_id');
        $data['categories'] = Category::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'cat_title' => 'required | unique:categories',
            'cat_status' => 'required',
            'acc_id' => 'required',
            'brand_id' => 'required'
        ], [
            'cat_title.unique' => 'Title Should be unique',
            'cat_title.required' => 'Title is required',
            'cat_status.required' => 'Status is required',
            'acc_id.required' => 'Brand is required',
            'brand_id.required' => 'Brand is required'

        ]);
        $info = array(
            'acc_id' => $request->input('acc_id'),
            'brand_id' => $request->input('brand_id'),
            'cat_title' => $request->input('cat_title'),
            'cat_status' => $request->input('cat_status')
        );
        Category::create($info);
        return redirect(route('category.index'))->with('message', 'Category has been Added');
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
        if (empty(trim($id)) or !is_numeric($id)) {
            return redirect(route('category.index'));
        }
        $data['title'] = 'Edit Category';
        $data['category'] = $country = Category::where('cat_id', '=', $id)->first();
        return view('category.update', $data);
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
            'cat_title' => 'required',
            'cat_status' => 'required',
            'acc_id' => 'required',
            'brand_id' => 'required'
        ], [
            'cat_title.unique' => 'Title Should be unique',
            'cat_title.required' => 'Title is required',
            'cat_status.required' => 'Status is required',
            'acc_id.required' => 'Brand is required',
            'brand_id.required' => 'Brand is required'

        ]);
        Category::where('cat_id', '=', $id)->update([
            'acc_id' => $request->input('acc_id'),
            'brand_id' => $request->input('brand_id'),
            'cat_title' => $request->input('cat_title'),
            'cat_status' => $request->input('cat_status')
        ]);
        return redirect(route('category.index'))->with('message', 'Category has been  update successfull');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('cat_id', '=', $id)->delete();
        return redirect(route('category.index'))->with('message', 'Category has been  Deleted successfull');
    }
}
