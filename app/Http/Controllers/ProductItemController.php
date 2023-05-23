<?php

namespace App\Http\Controllers;

use App\Models\Productitem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Itemdetail;
use Illuminate\Support\Facades\Session;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Items';
        $data['p_id'] = $request->input('p_id');
        $data['filter'] = "";

        $data['productitems'] = DB::table('productitems')
            ->when($request->p_id != null, function ($q) use ($request) {
                return $q->where('productitems.p_id', $request->p_id);
            })
            ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'productitems.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->leftjoin('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'productitems.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'productitems.p_id')
            ->where("products.acc_id", "=", Session::get('acc_id'))
            ->select('products.*', 'productitems.*', 'variants.*', 'product_sizes.*', 'product_serials.*', 'itemdetails.*')
            ->get();

        // echo "<pre>";
        // print_r($data);
        // exit;
        $data['filter'] = ($request->p_id) ? 1 : 0;
        return view('productitem.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = "")
    {
        return view('productitem.create', ['p_id' => $id]);
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
            'p_id' => 'required',
            'var_id' => 'required',
            'item_barcode_img' => 'required',
            'item_sku' => 'required',
            'item_asin' => 'required',
            'item_img' => 'required',
            'item_pur_price' => 'required',
        ], [
            'p_id.required' => 'Product is required',
            'var_id.required' => 'variant is required',
            'item_barcode_img.required' => 'Barcode Image is required',
            'item_sku.required' => 'SKU is required',
            'item_asin.required' => 'Asin is required',
            'item_img.required' => 'Item image is required',
            'item_pur_price.required' => 'Item Puchase price is required',
        ]);

        DB::beginTransaction();
        try {
            $p_id  = $request->input('p_id');
            $var_id  = $request->input('var_id');
            $item_sku = $request->input('item_sku');
            $item_asin = $request->input('item_asin');
            $item_pur_price = $request->input('item_pur_price');

            $counter = count($var_id);
            $data1 = array();
            $itemdetails_array = array();
            $barcodepath = 'uploads/Products/barcode';
            $itemimagepath = 'uploads/Products/itemimage';
            for ($i = 0; $i < $counter; $i++) {
                $item_barcode_img_name = "";
                $item_img_name  = "";
                $item_barcode_img_name = upload_image($request->file('item_barcode_img')[$i], $barcodepath);
                $item_img_name = upload_image($request->file('item_img')[$i], $itemimagepath);

                $data1 = array(
                    'p_id' => $p_id,
                    'var_id' => $var_id[$i],
                    'item_serial_no' => item_serial_number($p_id),
                    'item_barcode_img' => $item_barcode_img_name,
                    'item_sku' => $item_sku[$i],
                    'item_asin' => $item_asin[$i],
                    'item_img' => $item_img_name,
                );
                $productitem = Productitem::create($data1);
                $item_id = $productitem->id;

                $itemdetails_array = array(
                    'item_id' => $item_id,
                    'cost_per_unit' => "",
                    'item_pur_price' => $item_pur_price[$i],
                    'item_sale_price' => "",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                Itemdetail::insert($itemdetails_array);

                
            }
            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();
            echo "<pre>";
            print_r($data);
            exit;
        }
        return redirect(route('productitem.index'))->with('message', 'Item has been Added');
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
            return redirect(route('productitem.index'));
        }
        $data['title'] = 'Edit Item';
        //$data['items'] = Productitem::where('item_id', '=', $id)->first();
        $data['items'] = DB::table('productitems')
            ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'productitems.item_id')
            ->where('productitems.item_id', '=', $id)
            ->select('productitems.*', 'itemdetails.item_pur_price')
            ->first();
        return view('productitem.update', $data);
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
            'item_sku' => 'required',
            'item_asin' => 'required',
            'item_pur_price' => 'required',
        ], [

            'item_sku.required' => 'SKU is required',
            'item_asin.required' => 'Asin is required',
            'item_pur_price.required' => 'Item Puchase price is required',
        ]);
        DB::beginTransaction();
        try {
            $barcode_image = '';
            if ($request->hasFile('item_barcode_img')) {

                if (File::exists($request->file('item_barcode_img_old'))) {
                    File::delete($request->file('item_barcode_img_old'));
                }
                $path = 'uploads/Products/barcode';
                $barcode_image = upload_image($request->file('item_barcode_img'), $path);
            } else {
                $barcode_image = $request->input('item_barcode_img_old');
            }

            $item_image = '';
            if ($request->hasFile('item_img')) {

                if (File::exists($request->file('item_img_old'))) {
                    File::delete($request->file('item_img_old'));
                }
                $path = 'uploads/Products/itemimage';
                $item_image = upload_image($request->file('item_img'), $path);
            } else {
                $item_image = $request->input('item_img_old');
            }

            Productitem::where('item_id', '=', $id)->update([
                'item_sku' => $request->input('item_sku'),
                'item_asin' => $request->input('item_asin'),
                'item_barcode_img' => $barcode_image,
                'item_img' => $item_image,
            ]);

            Itemdetail::where('item_id', '=', $id)->update([
                'item_pur_price' => $request->input('item_pur_price'),
            ]);


            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }

        return redirect(route('productitem.index'))->with('message', 'Item has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productitem::where('item_id', '=', $id)->delete();
        return redirect(route('productitem.index'))->with('message', 'Item has been Deleted successfully');
    }
    public function product_item_price($id)
    {

        $data['item_price'] = DB::table('itemdetails')
            ->where('itemdetails.item_id', '=', $id)
            ->select('itemdetails.*')
            ->first();
        return view('productitem.update_price', $data);
    }

    public function update_price(Request $request, $id)
    {
        Itemdetail::where('item_id', '=', $id)->update([
            'item_sale_price' => $request->input('item_sale_price'),
        ]);
        return redirect(route('productitem.index'))->with('message', 'Item Price has been Updated successfully');
        
    }
}