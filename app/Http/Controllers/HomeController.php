<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        Session::put('acc_id', Auth::user()->acc_id);
        //$accounts_result = DB::table('accounts')->select('*')->where('acc_status', '=', '1')->get();
        //return view('account.view_accounts', ['accounts' => $accounts_result]);
        //return view('home');

        return to_route('dashboard', ['id' => base64_encode(Auth::user()->acc_id)]);
    }

    public function user_dashboard($id)
    {
        //$accounts_result = DB::table('accounts')->select('*')->where('acc_id', '=', $id)->get();
        //Session::put('acc_id', $accounts_result[0]->acc_id);
        //Session::put('acc_id', base64_decode($id));

        // dd(session()->all());
        //dd(Auth::user());
        //dd(Auth::user()->name);
        $acc_id = Session::get('acc_id');
        // $data['items']  = DB::table('products')
        //     ->leftjoin('productitems', 'productitems.p_id', '=', 'products.p_id')
        //     ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'products.p_id')
        //     ->leftjoin('product_serials', 'product_serials.p_id', '=', 'products.p_id')
        //     ->where("products.acc_id", "=", $acc_id)
        //     ->select(
        //         'products.*',
        //         'productitems.*',
        //         'product_sizes.*',
        //         'product_serials.*'
        //     )
        //     ->get();

        $data['brands'] = DB::table('brands')->where("acc_id", "=", $acc_id)->count();
        $data['categories'] = DB::table('categories')->where("acc_id", "=", $acc_id)->count();
        $data['products'] = DB::table('products')->where("acc_id", "=", $acc_id)->count();
        $data['productitems'] = DB::table('productitems')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->where("products.acc_id", "=", $acc_id)
            ->count();

        $data['results'] = DB::table('stockdetails as sd')
            ->selectRaw('SUM(id.item_pur_price * sd.stock_qty) as total_purchase_price')
            ->selectRaw('SUM(id.cost_per_unit * sd.stock_qty) as total_investment')
            ->selectRaw('SUM(id.item_sale_price * sd.stock_qty) as total_sale_price')
            ->join('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
            ->where("sd.acc_id", "=", $acc_id)
            ->first();

        $data['wherehouse_stats'] = DB::table('stockdetails as sd')
            ->select('sd.wh_id')
            ->selectRaw('SUM(id.item_pur_price * sd.stock_qty) as total_purchase_price_inwarehouse')
            ->selectRaw('SUM(id.cost_per_unit * sd.stock_qty) as total_investment_inwarehouse')
            ->selectRaw('SUM(id.item_sale_price * sd.stock_qty) as total_sale_price_inwarehouse')
            ->join('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
            ->where("sd.acc_id", "=", $acc_id)
            ->groupBy('sd.wh_id')
            ->get();

        //low stock calculations
        $data['low_stock'] = DB::table('products as p')
            ->select(
                'pi.item_id',
                'pi.item_serial_no',
                'p.p_name',
                'p.p_alert_qty',
                DB::raw('SUM(sd.stock_qty) as available_stock')
            )
            ->join('productitems as pi', 'p.p_id', '=', 'pi.p_id')
            ->join('stockdetails as sd', 'sd.item_id', '=', 'pi.item_id')
            ->where('p.acc_id', '=', $acc_id)
            ->groupBy('pi.item_id')
            ->havingRaw('SUM(sd.stock_qty) < p.p_alert_qty')
            ->count();

        //zero stock calculation
        $data['zero_stock'] = DB::table('products as p')
            ->select(
                'pi.item_id',
                'pi.item_serial_no',
                'p.p_name',
                'p.p_alert_qty',
                DB::raw('SUM(sd.stock_qty) as available_stock')
            )
            ->join('productitems as pi', 'p.p_id', '=', 'pi.p_id')
            ->join('stockdetails as sd', 'sd.item_id', '=', 'pi.item_id')
            ->where('p.acc_id', '=', $acc_id)
            ->groupBy('pi.item_id')
            ->havingRaw('SUM(sd.stock_qty) = 0')
            ->count();

        //sales stats calculation
        $data['sales_stats'] = DB::table('salesdetails as sd')
            ->join('sales as s', 's.sales_invoice_no', '=', 'sd.sales_invoice_no')
            ->join('itemdetails as id', 'id.item_id', '=', 'sd.item_id')
            ->select(
                DB::raw('count(s.sales_id) as sales'),
                DB::raw('sum(s.total_sales_amount) as rvenue'),
                DB::raw('sum(s.total_profit) as total_profit'),
                DB::raw('sum(id.cost_per_unit * sd.sale_qty) as total_investment')
            )
            ->where("s.acc_id", "=", $acc_id)
            ->whereMonth('s.sales_date', '=', date('m'))
            ->first();

        //calculate total purchses in cur month
        $data['total_purchases'] = DB::table('purchases as p')
            ->where('p.acc_id', '=', $acc_id)
            ->whereMonth('p.pur_date', '=', date('m'))
            ->count();

        $data['total_purchase_amount'] = DB::table('purchases as p')
            ->select(
                DB::raw('sum(p.pur_total_amount) as total_purchase'),
            )
            ->where('p.acc_id', '=', $acc_id)
            ->whereMonth('p.pur_date', '=', date('m'))
            ->first();




        // echo "<pre>";
        // print_r( $data['total_purchase_amount']);
        // exit;


        return view('home', $data);
    }

    function popup($page_name = '', $page_title = '', $param3 = '', $param4 = '')
    {
        return view($page_name);
    }
    function get_account_brands(Request $request)
    {
        $acc_id = $request->input('acc_id');
        $brands = DB::table('brands')
            ->where('acc_id', '=', $acc_id)
            ->where('brand_status', '=', '1')
            ->get();

        echo "<option value=''>Select Brand</option>";
        foreach ($brands as $rows) {
            echo "<option  value='" . $rows->brand_id . "'>" . $rows->brand_title . "</option>";
        }
    }
    function get_brand_categories(Request $request)
    {
        $brand_id = $request->input('brand_id');
        $categories = DB::table('categories')
            ->where('brand_id', '=', $brand_id)
            ->where('cat_status', '=', '1')
            ->get();

        echo "<option value=''>Select Category</option>";
        foreach ($categories as $rows) {
            echo "<option  value='" . $rows->cat_id . "'>" . $rows->cat_title . "</option>";
        }
    }
    function get_product_items(Request $request)
    {
        // $acc_id = $request->input('acc_id');
        $p_id = $request->input('p_id');
        $productitems = DB::table('productitems')
            ->join('products', 'products.p_id', '=', 'productitems.p_id')
            ->join('variants', 'variants.var_id', '=', 'productitems.var_id')
            ->where('products.p_id', '=', $p_id)
            ->where('products.p_status', '=', '1')
            // ->where('products.acc_id', '=', $acc_id)
            ->get();

        echo "<option value=''>Select Product</option>";
        foreach ($productitems as $rows) {
            echo "<option  value='" . $rows->item_id . "'>" . $rows->p_name . "(" . $rows->var_color . "-" . $rows->var_size . "-" . $rows->var_material . "-" . $rows->var_weight . " )</option>";
        }
    }
    function get_item_details(Request $request)
    {
        $acc_id = Session::get('acc_id');
        $item_id = $request->input('item_id');
        $result  = DB::table('products')
            ->leftjoin('productitems', 'productitems.p_id', '=', 'products.p_id')
            ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'productitems.item_id')
            ->leftjoin('product_sizes', 'product_sizes.p_id', '=', 'products.p_id')
            ->leftjoin('product_serials', 'product_serials.p_id', '=', 'products.p_id')
            ->select(
                'products.*',
                'itemdetails.*',
                'productitems.*',
                'product_sizes.*',
                'product_serials.*'
            )
            ->where('productitems.item_id', '=',  $item_id)
            ->where('products.acc_id', '=', $acc_id)
            ->get();

        return json_encode($result);
    }
    function get_item_quantity(Request $request)
    {
        $item_id = $request->input('item_id');
        $wh_id = $request->input('wh_id');

        $result  = DB::table('stockdetails')
            ->leftjoin('productitems', 'productitems.item_id', '=', 'stockdetails.item_id')
            ->leftjoin('products', 'products.p_id', '=', 'productitems.p_id')
            ->where('stockdetails.item_id', '=',  $item_id)
            ->where('stockdetails.wh_id', '=',  $wh_id)
            ->select(
                'stockdetails.stock_qty',
                'products.p_units_in_carton'
            )
            ->first();

        return json_encode($result);
    }
    function get_item_stock_details(Request $request)
    {
        $item_id = $request->input('item_id');
        $wh_id = $request->input('wh_id');

        $result  = DB::table('stockdetails')
            ->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'stockdetails.item_id')
            ->where('stockdetails.item_id', '=',  $item_id)
            ->where('stockdetails.wh_id', '=',  $wh_id)
            ->select(
                'stockdetails.*',
                'itemdetails.*'
            )
            ->first();

        return json_encode($result);
    }
}
