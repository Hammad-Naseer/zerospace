<?php

namespace App\Http\Controllers;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Variations';
        // $data['variants'] = Variant::all();
        $acc_id = Session::get('acc_id');
        $data['variants'] = Variant::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('variant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'var_color' => 'required',
        //     'var_size' => 'required',
        //     'var_material' => 'required'
        // ], [
        //     'var_color.required' => 'Color is required',
        //     'var_size.required' => 'Size is required',
        //     'var_material.required' => 'Material is required'
        // ]);
        $acc_id = Session::get('acc_id');
        $info = array(
        'var_color' => $request->input('var_color'),
        'var_size' => $request->input('var_size'),
        'var_material' => $request->input('var_material'),
        'var_weight' => $request->input('var_weight'),
        'acc_id' => $acc_id
        );
        Variant::create($info);
        return redirect(route('variant.index'))->with('message','Variant has been Added');
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
            return redirect(route('variant.index'));
        }
        $data['title'] = 'Edit Variant';
        $data['variant']  = variant::where('var_id','=',$id)->first();
        
        return view('variant.update', $data);
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
        // $validatedData = $request->validate([
        //     'var_color' => 'required',
        //     'var_size' => 'required',
        //     'var_material' => 'required'
        // ], [
        //     'var_color.required' => 'Color is required',
        //     'var_size.required' => 'Size is required',
        //     'var_material.required' => 'Material is required'
        // ]);
        Variant::where('var_id','=',$id)->update([
            'var_color' => $request->input('var_color'),
            'var_size' => $request->input('var_size'),
            'var_material' => $request->input('var_material'),
            'var_weight' => $request->input('var_weight')
        ]);
        return redirect(route('variant.index'))->with('message','Variant has been update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Variant::where('var_id','=',$id)->delete();
        return redirect(route('variant.index'))->with('message','Variant has been Deleted successfull');
    }
}