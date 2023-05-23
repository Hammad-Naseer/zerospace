<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Purchase;
use App\Models\Vendor;
use App\Models\Purchasedetail;
use App\Models\PurchaseDocuments;
use Illuminate\Support\Facades\Session;
use PDF;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'All Purchases';
        //$data['purchases'] = Purchase::all();
        $acc_id = Session::get('acc_id');
        $data['purchases'] = Purchase::select("*")->where("acc_id", "=", $acc_id)->get();
        return view('purchase.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.create');
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
            'vend_id' => 'required',
            'pur_date' => 'required',
            'pur_status' => 'required',
            'pur_total_amount' => 'required',
        ], [
            'vend_id.required' => 'Supplier is required',
            'pur_date.required' => 'Date is required',
            'pur_status.required' => 'Status is required',
            'pur_total_amount.required' => 'Total Amount is required',
        ]);
        DB::beginTransaction();
        try {
            // $pur_document ='';
            // if ($request->hasFile('pur_document')) {
            //     $path = 'uploads/orders';
            //     $pur_document = upload_image($request->file('pur_document') , $path);
            // }
            $acc_id = Session::get('acc_id');
            $pur_refrence_no = purchase_refrence_number();
            $info = array(
                'pur_refrence_no'  =>  $pur_refrence_no,
                'vend_id'  => $request->input('vend_id'),
                'pur_date'  => $request->input('pur_date'),
                'pur_document' => "",
                'pur_status' => $request->input('pur_status'),
                'pur_total_amount' => $request->input('pur_total_amount'),
                'remarks' => $request->input('remarks'),
                'alibaba_charges' => $request->input('alibaba_charges'),
                'shipping_charges' => $request->input('shipping_charges'),
                'miscellaneous_charges' => $request->input('miscellaneous_charges'),
                'acc_id' => $acc_id
            );
            $purchase = Purchase::create($info);
            $pur_id = $purchase->id;

            if ($pur_id > 0) {
                if ($request->hasFile('pur_document')) {
                    $path = 'uploads/orders';
                    $files = $request->file('pur_document');
                    foreach ($files as $file) {
                        if ($file->isValid()) {
                            $pur_document_multiple = upload_image($file, $path);
                            $doc = array(
                                'pur_id' => $pur_id,
                                'pur_document' => $pur_document_multiple,
                                'pur_refrence_no' => $pur_refrence_no
                            );
                            PurchaseDocuments::insert($doc);
                        } else {
                            // handle file upload error
                        }
                    }
                }
            }


            $item_id = $request->input('item_id');
            $item_purchase_price  = $request->input('item_pur_price');
            $units_in_carton  = $request->input('units_in_carton');
            $pur_item_qty  = $request->input('pur_item_qty');
            $carton_qty  = $request->input('carton_qty');
            $sub_total_amount  = $request->input('sub_total_amount');


            $counter = count($item_id);
            $data1 = array();
            for ($i = 0; $i < $counter; $i++) {
                $data1[] =
                    array(
                        'pur_id' =>  $pur_id,
                        'item_id' => $item_id[$i],
                        'item_purchase_price' => $item_purchase_price[$i],
                        'units_in_carton' =>   $units_in_carton[$i],
                        'pur_item_qty' =>  $pur_item_qty[$i],
                        'carton_qty' => $carton_qty[$i],
                        'sub_total_amount' => $sub_total_amount[$i]
                    );
            }
            Purchasedetail::insert($data1);
            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();

            echo "<pre>";
            print_r($data);
            exit;
        }
        return redirect(route('purchase.index'))->with('message', 'Purchase has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (empty(trim($id)) or !is_numeric($id)) {
            return redirect(route('purchase.index'));
        }
        $data['title'] = 'Show Purchase';
        $data['purchase'] = DB::table('purchases')->where('pur_id', '=', $id)->get();
        // $data['purchase_detail'] = DB::table('purchasedetails')->where('pur_id','=',$id)->get();
        $data['purchase_detail'] = DB::table('purchasedetails')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'purchasedetails.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->select('purchasedetails.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*')
            ->where('purchasedetails.pur_id', '=', $id)
            ->get();
        return view('purchase.show', $data);
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
            return redirect(route('purchase.index'));
        }
        $data['title'] = 'Edit Purchase';
        $data['purchase'] = DB::table('purchases')->where('pur_id', '=', $id)->first();
        $data['purchase_detail'] = DB::table('purchasedetails')->where('pur_id', '=', $id)->get();
        return view('purchase.update', $data);
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
            'vend_id' => 'required',
            'pur_date' => 'required',
            'pur_status' => 'required',
            'pur_total_amount' => 'required',
        ], [
            'vend_id.required' => 'Supplier is required',
            'pur_date.required' => 'Date is required',
            'pur_status.required' => 'Status is required',
            'pur_total_amount.required' => 'Total Amount is required',
        ]);

        DB::beginTransaction();
        try {
            $transit_date = $request->input('transit_date');
            $received_date = $request->input('received_date');
          
            // $pur_document = '';
            // if ($request->hasFile('pur_document')) {
            //     if (File::exists($request->file('pur_doc_old'))) {
            //         File::delete($request->file('pur_doc_old'));
            //     }
            //     $path = 'uploads/orders';
            //     $pur_document = upload_image($request->file('pur_document'), $path);
            // } else {
            //     $pur_document = $request->input('pur_doc_old');
            // }

            Purchase::where('pur_id', '=', $id)->update([
                'vend_id'  => $request->input('vend_id'),
                'pur_date'  => $request->input('pur_date'),
                'pur_status' => $request->input('pur_status'),
                'pur_document' => "",
                'pur_total_amount' => $request->input('pur_total_amount'),
                'remarks' => $request->input('remarks'),
                'alibaba_charges' => $request->input('alibaba_charges'),
                'shipping_charges' => $request->input('shipping_charges'),
                'miscellaneous_charges' => $request->input('miscellaneous_charges'),
                'transit_date' => $transit_date,
                'received_date' => $received_date
            ]);

            $pur_refrence_no = $request->input('pur_refrence_no');
            if ($id > 0) {
                if ($request->hasFile('pur_document')) {
                    $path = 'uploads/orders';
                    $files = $request->file('pur_document');
                    foreach ($files as $file) {
                        if ($file->isValid()) {
                            $pur_document_multiple = upload_image($file, $path);
                            $doc = array(
                                'pur_id' => $id,
                                'pur_document' => $pur_document_multiple,
                                'pur_refrence_no' => $pur_refrence_no
                            );
                            PurchaseDocuments::insert($doc);
                        } else {
                            // handle file upload error
                        }
                    }
                }
            }
            $pur_detail_id = $request->input('pur_detail_id');
            $item_id = $request->input('item_id');
            $item_purchase_price  = $request->input('item_pur_price');
            $units_in_carton  = $request->input('units_in_carton');
            $pur_item_qty  = $request->input('pur_item_qty');
            $carton_qty  = $request->input('carton_qty');
            $sub_total_amount  = $request->input('sub_total_amount');

            Purchasedetail::where('pur_id', '=', $id)->delete();

            $counter = count($item_id);
            $data1 = array();
            for ($i = 0; $i < $counter; $i++) {
                $data1[] =
                    array(
                        'pur_id' => $id,
                        'item_id' => $item_id[$i],
                        'item_purchase_price' => $item_purchase_price[$i],
                        'units_in_carton' =>   $units_in_carton[$i],
                        'pur_item_qty' =>  $pur_item_qty[$i],
                        'carton_qty' => $carton_qty[$i],
                        'sub_total_amount' => $sub_total_amount[$i]
                    );
            }
            Purchasedetail::insert($data1);

            DB::commit();
        } catch (\Exception $e) {
            $data_error = $e->getMessage();
        }
        return redirect(route('purchase.index'))->with('message', 'Purchase has been Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::where('pur_id', '=', $id)->delete();
        Purchasedetail::where('pur_id', '=', $id)->delete();
        return redirect(route('purchase.index'))->with('message', 'Purchase has been Deleted successfull');
    }

    public function print($id)
    {
        $data['title'] = 'Show Purchase';
        $data['purchase'] = DB::table('purchases')->where('pur_id', '=', $id)->get();
        //$data['purchase_detail'] = DB::table('purchasedetails')->where('pur_id','=',$id)->get();

        $data['purchase_detail'] = DB::table('purchasedetails')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'purchasedetails.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->select('purchasedetails.*', 'products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*')
            ->where('purchasedetails.pur_id', '=', $id)
            ->get();

        $pur_refrence_no = $data['purchase'][0]->pur_refrence_no;
        //return view('purchase.print', $data);
        $pdf = PDF::loadView('purchase.print', $data);
        return $pdf->download('purchase order number ' . $pur_refrence_no . '.pdf');
    }
    public function filterpurchase(Request $request)
    {

        $query = Purchase::query();
        $supplier = Vendor::all();

        if ($request->ajax()) {
            $supplier = $query->where(['vend_id' => $request->supply_id])->get();
            return response()->json(['purchases' => $supplier]);
        }
        $purchases = $query->get();
        return view('purchase.index', compact('purchases', 'supplier'));
    }
}
