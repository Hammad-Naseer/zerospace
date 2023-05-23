<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Models\Product;

use App\Models\Product_size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['title'] = 'All Products';
        $data['brand_id'] = $request->query('brand_id');
        $data['cat_id'] = $request->query('cat_id');

        $data['products'] = DB::table('products')
            ->when($request->acc_id != null, function ($q) use ($request) {
                return $q->whereDate('products.acc_id', $request->acc_id);
            })
            ->when($request->brand_id != null, function ($q) use ($request) {
                return $q->where('products.brand_id', $request->brand_id);
            })
            ->when($request->cat_id != null, function ($q) use ($request) {
                return $q->where('products.cat_id', $request->cat_id);
            })
            ->leftJoin('accounts', 'accounts.acc_id', '=', 'products.acc_id')
            ->leftJoin('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')
            ->leftJoin('product_sizes', 'product_sizes.p_id', '=', 'products.p_id')
            ->leftJoin('product_serials', 'product_serials.p_id', '=', 'products.p_id')
            ->where("products.acc_id", "=", Session::get('acc_id'))
            ->select(
                'products.*',
                'accounts.acc_title',
                'brands.brand_title',
                'categories.cat_title',
                'product_sizes.*',
                'product_serials.*'
            )
            ->get();
        $data['filter'] = ($request->acc_id || $request->brand_id || $request->cat_id) ? 1 : 0;
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Product';
        return view('product.create');
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
            'acc_id' => 'required',
            'brand_id' => 'required',
            'cat_id' => 'required',
            'p_name' => 'required',
            'p_status' => 'required',
            'p_serial_starts_from' => 'required',
            'p_alert_qty' => 'required'
        ], [
            'acc_id.required' => 'Account is required',
            'brand_id.required' => 'Brand is required',
            'cat_id.required' => 'category is required',
            'p_name.required' => 'Title is required',
            'p_status.required' => 'Status is required',
            'p_serial_starts_from.required' => 'Serial Initial is Required',
            'p_alert_qty.required' => 'Alert Quantity is Required'
        ]);
        DB::beginTransaction();
        try {

            //******************product table insertion*****************
            $info = array(
                'acc_id' => $request->input('acc_id'),
                'brand_id' => $request->input('brand_id'),
                'cat_id' => $request->input('cat_id'),
                'p_name' => $request->input('p_name'),
                'p_description' => $request->input('p_description'),
                'p_status' => $request->input('p_status'),
                'p_units_in_carton' => $request->input('p_units_in_carton'),
                'p_net_weight' => $request->input('p_net_weight'),
                'p_gross_weight' => $request->input('p_gross_weight'),
                'p_alert_qty' => $request->input('p_alert_qty'),
                'p_listing_owner' => ""
            );
            $product = Product::create($info);
            $lastInsertID = $product->id;

            //******************product_sizes table insertion*****************
            $product_sizes = array(
                'p_id' => $lastInsertID,
                'p_box_size_length' => $request->input('p_box_size_length'),
                'p_box_size_width' => $request->input('p_box_size_width'),
                'p_box_size_height' => $request->input('p_box_size_height'),
                'p_box_size_unit' => $request->input('p_box_size_unit'),
                'p_carton_size_length' => $request->input('p_carton_size_length'),
                'p_carton_size_width' => $request->input('p_carton_size_width'),
                'p_carton_size_height' => $request->input('p_carton_size_height'),
                'p_carton_size_unit' => $request->input('p_carton_size_unit'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            Product_size::insert($product_sizes);

            //******************product_serials table insertion*****************
            DB::table('product_serials')->insert([
                'p_id' => $lastInsertID,
                'p_serial_starts_from' => $request->input('p_serial_starts_from'),
                'p_serial_current' => $request->input('p_serial_starts_from'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }
        if (!empty($product))
            return redirect(route('product.index'))->with('message', "Product has been Added Successfull ");
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
        //return view('product.show');
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
            return redirect(route('product.index'));
        }
        $data['title'] = 'Edit Product';
        $data['product'] = DB::table('products')
            ->leftjoin('accounts', 'products.acc_id', '=', 'accounts.acc_id')
            ->leftjoin('brands', 'products.brand_id', '=', 'brands.brand_id')
            ->leftjoin('categories', 'products.cat_id', '=', 'categories.acc_id')
            ->leftjoin('product_sizes', 'products.p_id', '=', 'product_sizes.p_id')
            ->leftjoin('product_serials', 'products.p_id', '=', 'product_serials.p_id')
            ->select(
                'products.*',
                'products.p_id',
                'brands.*',
                'brands.brand_title',
                'products.p_name',
                'accounts.*',
                'accounts.acc_title',
                'categories.cat_title',
                'product_sizes.*',
                'product_serials.*'
            )
            ->where('products.p_id', '=', $id)
            ->first();
        return view('product.update', $data);
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
            'acc_id' => 'required',
            'brand_id' => 'required',
            'cat_id' => 'required',
            'p_name' => 'required',
            'p_status' => 'required',
            'p_serial_starts_from' => 'required',
            'p_alert_qty' => 'required'
        ], [
            'acc_id.required' => 'Account is required',
            'brand_id.required' => 'Brand is required',
            'cat_id.required' => 'category is required',
            'p_name.required' => 'Title is required',
            'p_status.required' => 'Status is required',
            'p_serial_starts_from.required' => 'Serial Initial is Required',
            'p_alert_qty.required' => 'Alert Quantity is Required'

        ]);
        DB::beginTransaction();
        try {
            //******************product table update*****************
            Product::where('p_id', '=', $id)->update([
                'acc_id' => $request->input('acc_id'),
                'brand_id' => $request->input('brand_id'),
                'cat_id' => $request->input('cat_id'),
                'p_name' => $request->input('p_name'),
                'p_description' => $request->input('p_description'),
                'p_status' => $request->input('p_status'),
                'p_units_in_carton' => $request->input('p_units_in_carton'),
                'p_net_weight' => $request->input('p_net_weight'),
                'p_gross_weight' => $request->input('p_gross_weight'),
                'p_alert_qty' => $request->input('p_alert_qty'),
                'p_listing_owner' => ""
            ]);

            //******************product_sizes table update*****************
            Product_size::where('p_id', '=', $id)->update([
                'p_box_size_length' => $request->input('p_box_size_length'),
                'p_box_size_width' => $request->input('p_box_size_width'),
                'p_box_size_height' => $request->input('p_box_size_height'),
                'p_box_size_unit' => $request->input('p_box_size_unit'),
                'p_carton_size_length' => $request->input('p_carton_size_length'),
                'p_carton_size_width' => $request->input('p_carton_size_width'),
                'p_carton_size_height' => $request->input('p_carton_size_height'),
                'p_carton_size_unit' => $request->input('p_carton_size_unit'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            //******************product_serials table update*****************
            DB::table('product_serials')
                ->where('p_id', $id)
                ->update([
                    'p_serial_starts_from' => $request->input('p_serial_starts_from'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            DB::commit();
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }
        return redirect(route('product.index'))->with('message', 'product has been  update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('p_id', '=', $id)->delete();
        return redirect(route('product.index'))->with('message', 'Product has been  Deleted successfull');
    }
}