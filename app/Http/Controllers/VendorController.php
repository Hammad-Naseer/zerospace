<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vendor;
use Illuminate\Support\Facades\Session;



class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Vendors';
        // $data['vendors'] = Vendor::all();
        $acc_id = Session::get('acc_id');
        $data['vendors'] = Vendor::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('vendor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Vendor';
        return view('vendor.create', $data);
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
            'vend_name' => 'required | unique:vendors',
            'vend_city' => 'required',
            'vend_status' => 'required',
        ], [
            'vend_name.unique' => 'Title Should be unique',
            'vend_name.required' => 'Title is required',
            'vend_city.required' => 'City is required',
            'vend_status.required' => 'Status is required',
        ]);
        $acc_id = Session::get('acc_id');
        $info = array(
            'vend_name' => $request->input('vend_name'),
            'vend_city' => $request->input('vend_city'),
            'vend_mobile' => $request->input('vend_mobile'),
            'vend_status' => $request->input('vend_status'),
            'vend_profile' => $request->input('vend_profile'),
            'p_id' => $request->input('p_id'),
            'acc_id' => $acc_id
        );
        $vendor = Vendor::create($info);
        if (!empty($vendor))
            return redirect(route('vendor.index'))->with('message', "Supplier has been Added Successfull ");
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
    public function edit($vendor_id)
    {
        $data['title'] = 'Edit Category';
        $data['vendor']  = Vendor::where('vend_id', '=', $vendor_id)->first();
        return view('vendor.update', $data);
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
            'vend_name' => 'required',
            'vend_city' => 'required',
            'vend_status' => 'required',
        ]);
        Vendor::where('vend_id', '=', $id)->update([
            'vend_name' => $request->input('vend_name'),
            'vend_city' => $request->input('vend_city'),
            'vend_status' => $request->input('vend_status'),
            'p_id' => $request->input('p_id')
        ]);
        return redirect(route('vendor.index'))->with('message', 'Supplier has been  Update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendor::where('vend_id', '=', $id)->delete();
        return redirect(route('vendor.index'))->with('message', 'Supplier has been  Deleted successfull');
    }
}
