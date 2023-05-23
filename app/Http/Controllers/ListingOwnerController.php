<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listingowner;


class ListingOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Owners';
        $data['listingowners'] = Listingowner::all();
        return view('listingowner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listingowner.create');
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
            'list_owner_name' => 'required | unique:listingowners',
            'list_owner_status' => 'required',
        ], [
            'list_owner_name.unique' => 'Title Should be unique',
            'list_owner_name.required' => 'Title is required',
            'list_owner_status.required' => 'Status is required',

        ]);

        $info = array(
        'list_owner_name' => $request->input('list_owner_name'),
        'list_owner_status' => $request->input('list_owner_status')
        );
        Listingowner::create($info);
        return redirect(route('listingowner.index'))->with('message','Listing Owner has been Added');
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
            return redirect(route('listingowner.index'));
            }
            $data['title'] = 'Edit Listing Owner';
            $data['listingowners']  = Listingowner::where('list_owner_id','=',$id)->first();
            return view('listingowner.update', $data);
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
            'list_owner_name' => 'required',
            'list_owner_status' => 'required',
        ], [
            'list_owner_name.unique' => 'Title Should be unique',
            'list_owner_name.required' => 'Title is required',
            'list_owner_status.required' => 'Status is required',

        ]);
        Listingowner::where('list_owner_id','=',$id)->update([
            'list_owner_name' => $request->input('list_owner_name'),
            'list_owner_status' => $request->input('list_owner_status')
        ]);
        return redirect(route('listingowner.index'))->with('message','Listing Owner has been  update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Listingowner::where('list_owner_id','=',$id)->delete();
        return redirect(route('listingowner.index'))->with('message','Listing Owner has been  Deleted successfull');
    }
}