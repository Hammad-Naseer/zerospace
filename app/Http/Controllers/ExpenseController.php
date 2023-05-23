<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Expenses';
        $data['exp_cat_id'] = $request->query('exp_cat_id');
        $data['start_date'] = $request->query('start_date');
        $data['end_date'] = $request->query('end_date');

        // echo "<pre>";
        // print_r($data);
        // DB::enableQueryLog();
        $acc_id = Session::get('acc_id');
        $data['expenses'] = DB::table('expenses')
        ->when($request->exp_cat_id != null, function ($q) use ($request) {
            return $q->where('expenses.exp_cat_id', $request->exp_cat_id);
        })
        ->when($request->start_date != null && $request->end_date != null, function ($q) use ($request) {
            return $q->whereBetween('expenses.exp_date', [$request->start_date, $request->end_date]);
        })
        ->where("acc_id", "=", $acc_id)
        ->get();

        // dd(DB::getQueryLog());
     
        $data['filter'] = ($request->exp_cat_id || $request->start_date ) ? 1 : 0;
        return view('expenses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
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
            'exp_cat_id' => 'required',
            'exp_date' => 'required',
            'exp_amount' => 'required',
            'exp_details' => 'required',
        ], [
            'exp_cat_id.required' => 'Category is required',
            'exp_date.required' => 'Date is required',
            'exp_amount.required' => 'Amount is required',
            'exp_details.required' => 'Details are required',

        ]);
        $acc_id = Session::get('acc_id');
        $info = array(
            'exp_cat_id' => $request->input('exp_cat_id'),
            'exp_date' => $request->input('exp_date'),
            'exp_amount' => $request->input('exp_amount'),
            'exp_details' => $request->input('exp_details'),
            'acc_id' => $acc_id
        );
        Expense::create($info);
        return redirect(route('expenses.index'))->with('message', 'Expense has been Added');
    }

    function print_expenses(Request $request)
    {
        $data['title'] = 'Expenses Print';
        $data['exp_cat_id'] = $request->input('exp_cat_id');
        $data['start_date'] = $request->input('start_date');
        $data['end_date'] = $request->input('end_date');
        $acc_id = Session::get('acc_id');
        $data['expenses'] = DB::table('expenses')
        ->when($request->exp_cat_id != null, function ($q) use ($request) {
            return $q->where('expenses.exp_cat_id', $request->exp_cat_id);
        })
        ->when($request->start_date != null && $request->end_date != null, function ($q) use ($request) {
            return $q->whereBetween('expenses.exp_date', [$request->input('start_date'), $request->input('end_date')]);
        })
        ->where("acc_id", "=", $acc_id)
        ->get();

        // echo "<pre>";
        // print_r($data);
        // exit;

        $pdf = PDF::loadView('expenses.print', $data);
        return $pdf->download('Expense.pdf');
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
