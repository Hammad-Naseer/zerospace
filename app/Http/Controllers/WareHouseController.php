<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Session;

class WareHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All WareHouse';
        //$data['warehouses'] = Warehouse::all();
        $acc_id = Session::get('acc_id');
        $data['warehouses'] = Warehouse::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('warehouse.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'All WareHouse';
        return view('warehouse.create',$data);
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
            'wh_title' => 'required',
            'wh_location' => 'required',
            'wh_status' => 'required',
            ], [
                'wh_title.unique' => 'Warehouse Name Should be unique',
                'wh_title.required' => 'Warehouse Title is required',
                'wh_location.required' => 'Warehouse Loaction is required',
                'wh_status.required' => 'Warehouse Status is required',
            ]);
            $acc_id = Session::get('acc_id');
            $info = array(
                'wh_title' => $request->input('wh_title'),
                'wh_contactperson' => $request->input('wh_contactperson'),
                'wh_contactnumber' => $request->input('wh_contactnumber'),
                'wh_location' => $request->input('wh_location'),
                'wh_status' => $request->input('wh_status'),
                'acc_id' => $acc_id
                ); 
            $warehouse = Warehouse::create($info);
            if(!empty($warehouse))
            return redirect(route('warehouse.index'))->with('message',"WareHouse has been Added Successfull ");
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
        $data['title'] = 'Edit WareHouse';
        $data['warehouse']  = Warehouse::where('wh_id','=',$id)->first();
        return view('warehouse.update', $data);
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
            'wh_title' => 'required',
            'wh_location' => 'required',
            'wh_status' => 'required',
            ], [
                'wh_title.unique' => 'Warehouse Name Should be unique',
                'wh_title.required' => 'Warehouse Title is required',
                'wh_location.required' => 'Warehouse Loaction is required',
                'wh_status.required' => 'Warehouse Status is required',
            ]);
            Warehouse::where('wh_id','=',$id)->update([
                'wh_title' => $request->input('wh_title'),
                'wh_contactperson' => $request->input('wh_contactperson'),
                'wh_contactnumber' => $request->input('wh_contactnumber'),
                'wh_location' => $request->input('wh_location'),
                'wh_status' => $request->input('wh_status')
            ]);
                return redirect(route('warehouse.index'))->with('message','WareHouse has been  Update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::where('wh_id','=',$id)->delete();
        return redirect(route('warehouse.index'))->with('message','WareHouse has been  Deleted successfull');
    }
}