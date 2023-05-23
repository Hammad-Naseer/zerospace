<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Expensecategorie;
use Illuminate\Support\Facades\Session;


class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Owners';
        //$data['expensecategories'] = Expensecategorie::all();
        $acc_id = Session::get('acc_id');
        $data['expensecategories'] = Expensecategorie::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('expensecategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expensecategory.create');
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
            'exp_cat_title' => 'required | unique:expensecategories',
        ], [
            'exp_cat_title.unique' => 'Title Should be unique',
            'exp_cat_title.required' => 'Title is required',

        ]);
        $acc_id = Session::get('acc_id');
        $info = array(
        'exp_cat_title' => $request->input('exp_cat_title'),
        'exp_cat_code' => $request->input('exp_cat_code'),
        'acc_id' => $acc_id
        );
        Expensecategorie::create($info);
        return redirect(route('expensecategory.index'))->with('message','Expense Category has been Added');
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
            return redirect(route('expensecategory.index'));
            }
            $data['title'] = 'Edit Expense Category';
            $data['expensecategories']  = Expensecategorie::where('exp_cat_id','=',$id)->first();
            return view('expensecategory.update', $data);
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
            'exp_cat_title' => 'required',
        ], [
            'exp_cat_title.required' => 'Title is required',

        ]);

        Expensecategorie::where('exp_cat_id','=',$id)->update([
            'exp_cat_title' => $request->input('exp_cat_title'),
            'exp_cat_code' => $request->input('exp_cat_code')
        ]);
        return redirect(route('expensecategory.index'))->with('message','Expense Category has been update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expensecategorie::where('exp_cat_id','=',$id)->delete();
        return redirect(route('expensecategory.index'))->with('message','Expense Category has been Deleted successfull');
    }
    
}
