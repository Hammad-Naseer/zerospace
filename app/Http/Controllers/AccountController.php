<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Account;
use Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data['title'] = 'All Accounts';
        $data['accounts'] = Account::all();
        return view('account.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
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
            'acc_title' => 'required | unique:accounts',
            'acc_status' => 'required',
        ], [
            'acc_title.unique' => 'Title Should be unique',
            'acc_title.required' => 'Title is required',
            'acc_status.required' => 'Status is required',

        ]);

        $info = array(
        'acc_title' => $request->input('acc_title'),
        'acc_status' => $request->input('acc_status')
        );
        Account::create($info);
        return redirect(route('account.index'))->with('message','Account has been Added');
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
            return redirect(route('account.index'));
            }
            $data['title'] = 'Edit Account';
            $data['account'] = $country = Account::where('acc_id','=',$id)->first();
            return view('account.update', $data);
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
            'acc_title' => 'required',
            'acc_status' => 'required',
        ], [
            'acc_title.unique' => 'Title Should be unique',
            'acc_title.required' => 'Title is required',
            'acc_status.required' => 'Status is required',

        ]);
        Account::where('acc_id','=',$id)->update([
        'acc_title' => $request->input('acc_title'),
        'acc_status' => $request->input('acc_status')
        ]);
        return redirect(route('account.index'))->with('message','Account has been  update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::where('acc_id','=',$id)->delete();
        return redirect(route('account.index'))->with('message','Account has been  Deleted successfull');
    }
}