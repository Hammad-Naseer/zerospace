<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

function account_dropdown($selected = 0)
{
	$reg_array = DB::table('accounts')->select('*')
		->where('acc_status', '=', '1')
		->where("acc_id", "=", Session::get('acc_id'))
		->get();
	$str = '<option value="">Select Account</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->acc_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->acc_id . '" ' . $opt_selected . '>' . $row->acc_title . '</option>';
	}
	return $str;
}
function get_account_details($id = 0)
{
	$result = DB::table('accounts')->where('acc_id', $id)->first();
	return $result;
}
function listingowners_dropdown($selected = 0)
{
	$reg_array = DB::table('listingowners')->select('*')
		->where('list_owner_status', '=', '1')
		->get();
	$str = '<option value="">Select Listing Owner</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->list_owner_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->list_owner_id . '" ' . $opt_selected . '>' . $row->list_owner_name . '</option>';
	}
	return $str;
}
function get_listingowners_details($id = 0)
{
	$result = DB::table('listingowners')->where('list_owner_id', $id)->first();
	return $result;
}
function brand_dropdown($selected = 0)
{
	$reg_array = DB::table('brands')->select('*')
	->where("acc_id", "=", Session::get('acc_id'))->get();
	$str = '<option value="">Select Brand</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->brand_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->brand_id . '" ' . $opt_selected . '>' . $row->brand_title . '</option>';
	}
	return $str;
}
function get_brand_details($id = 0)
{
	$result = DB::table('brands')->where('brand_id', $id)->first();
	return $result;
}
function status_dropdown($select = 0, $name = "", $id = "")
{
	$status = array(
		'1'	=>	'Active',
		'0'	=>	'Inactive',
	);
	$output = '';
	$output .= "<select class='form-control' name=" . $name . " id=" . $id . " required>";
	$output .= "<option value=''>Select Status</option>";
	for ($i = 0; $i < count($status); $i++) :
		$selected = '';
		if ($select == $i) :
			$selected = "selected";
		endif;
		$output .= "<option value='" . $i . "' " . $selected . ">" . $status[$i] . "</option>";
	endfor;

	$output .= "</select>";

	return $output;
}
function status($id = 0)
{
	$color = "";
	if ($id == 1) {
		$color = "green";
	} elseif ($id == 0) {
		$color = "red";
	}
	$status = array(
		'1'	=>	'Active',
		'0'	=>	'Inactive',
	);

	return "<span style='color:" . $color . ";'>" . $status[$id] . "</span>";
}
function category_dropdown($selected = 0)
{
	$reg_array = DB::table('categories')->select('*')
		->where('cat_status', '=', '1')
		->where("acc_id", "=", Session::get('acc_id'))
		->get();
	$str = '<option value="">Select Category</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->cat_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->cat_id . '" ' . $opt_selected . '>' . $row->cat_title . '</option>';
	}
	return $str;
}
function variant_dropdown($selected = 0)
{
	$reg_array = DB::table('variants')
	->where("acc_id", "=", Session::get('acc_id'))
	->select('*')->get();
	$str = "<option value=''>Select Variant</option>";
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->var_id) {
			$opt_selected = "selected";
		}
		$var_color = "";
		if($row->var_color != ""){
			$var_color = $row->var_color;
		}
		$var_size = "";
		if($row->var_size != ""){
			$var_size = "-".$row->var_size;
		}
		$var_material = "";
		if($row->var_material != ""){
			$var_material = "-".$row->var_material;
		}
		$var_weight = "";
		if($row->var_weight != ""){
			$var_weight = "-".$row->var_weight;
		}
		$str .= "<option value='" . $row->var_id . "'" . $opt_selected . ">" . $var_color . "" . $var_size . "" . $var_material . "" . $var_weight . "</option>";
	}
	return $str;
}
function upload_image($img_name = "", $img_path = "")
{
	$filenameWithExtension = $img_name->getClientOriginalName();
	$filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
	$extension = $img_name->getClientOriginalExtension();
	$fileNameToStore = $filename . '-' . time() . '.' . $extension;
	$item_barcode_img_name =  $img_name->storeAs($img_path, $fileNameToStore);

	return $item_barcode_img_name;
}
function product_dropdown($selected = 0)
{
	$reg_array = DB::table('products')
	->where("products.acc_id", "=", Session::get('acc_id'))
	->select('*')
		->where('p_status', '=', '1')
		->get();
	$str = '<option value="">Select Product</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->p_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->p_id . '" ' . $opt_selected . '>' . $row->p_name . '</option>';
	}
	return $str;
}
function get_product_details($id = 0)
{
	$result = DB::table('products')->where('p_id', $id)->first();
	return $result;
}
function vendor_dropdown($selected = 0)
{
	$reg_array = DB::table('vendors')->select('*')
		->where('vend_status', '=', '1')
		->where("acc_id", "=", Session::get('acc_id'))
		->get();
	$str = '<option value="">Select Supplier</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->vend_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->vend_id . '" ' . $opt_selected . '>' . $row->vend_name . '</option>';
	}
	return $str;
}
function get_vendor_details($id = 0)
{
	$result = DB::table('vendors')->where('vend_id', $id)->first();
	return $result;
}
function warehouse_dropdown($selected = 0)
{
	$reg_array = DB::table('warehouses')->select('*')
		->where('wh_status', '=', '1')
		->where("acc_id", "=", Session::get('acc_id'))
		->get();
	$str = '<option value="">Select WareHouse</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->wh_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->wh_id . '" ' . $opt_selected . '>' . $row->wh_title . '</option>';
	}
	return $str;
}
function get_warehouse_details($id = 0)
{
	$result = DB::table('warehouses')->where('wh_id', $id)->first();
	return $result;
}
function purchase_status_dropdown($select = 0, $name = "", $id = "")
{
	$status = array(
		'1'	=>	'Pending',
		'2'	=>	'Ordered',
		'3'	=>	'InTransit',
		'4'	=>	'Received',
		'5'	=>	'Cancel',
	);
	$output = '';
	$output .= "<select class='form-control' name=" . $name . " id=" . $id . " required>";
	$output .= "<option value=''>Select Status</option>";
	for ($i = 1; $i < count($status); $i++) :
		$selected = '';
		if ($select == $i) :
			$selected = "selected";
		endif;
		$output .= "<option value='" . $i . "' " . $selected . ">" . $status[$i] . "</option>";
	endfor;

	$output .= "</select>";

	return $output;
}
function purchase_status($id = 0)
{
	$status = array(
		'1'	=>	'Pending',
		'2'	=>	'Ordered',
		'3'	=>	'In Transit',
		'4'	=>	'Receved',
		'5'	=>	'Cancel',
	);

	return "<span>" . $status[$id] . "</span>";
}
function stock_status_dropdown($select = 0, $name = "", $id = "")
{
	$status = array(
		'1'	=>	'Pending',
		'2'	=>	'In Transit',
		'3'	=>	'Completed',
	);
	$output = '';
	$output .= "<select class='form-control' name=" . $name . " id=" . $id . ">";
	$output .= "<option value=''>Select Status</option>";
	for ($i = 1; $i < count($status); $i++) :
		$selected = '';
		if ($select == $i) :
			$selected = "selected";
		endif;
		$output .= "<option value='" . $i . "' " . $selected . ">" . $status[$i] . "</option>";
	endfor;

	$output .= "</select>";

	return $output;
}
function items_dropdown($selected = 0)
{
	$reg_array = DB::table('productitems')
		->join('products', 'productitems.p_id', '=', 'products.p_id')
		->join('variants', 'variants.var_id', '=', 'productitems.var_id')
		->where("products.acc_id", "=", Session::get('acc_id'))
		->select('products.*', 'productitems.*', 'variants.*')
		->get();

	$str = "<option value=''>Select Items</option>";
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->item_id) {
			$opt_selected = 'selected';
		}

		if ($selected == $row->var_id) {
			$opt_selected = "selected";
		}
		$var_color = "";
		if($row->var_color != ""){
			$var_color = $row->var_color;
		}
		$var_size = "";
		if($row->var_size != ""){
			$var_size = "-".$row->var_size;
		}
		$var_material = "";
		if($row->var_material != ""){
			$var_material = "-".$row->var_material;
		}
		$var_weight = "";
		if($row->var_weight != ""){
			$var_weight = "-".$row->var_weight;
		}

		//$str .= "<option value='".$row->item_id."' ".$opt_selected.">".$row->p_name."_".$row->item_sku."_".$row->item_asin." (".$row->var_color."-".$row->var_size."-".$row->var_material."-".$row->var_weight." ) </option>";
		$str .= "<option  value='" . $row->item_id . "' " . $opt_selected . ">" . $row->item_serial_no . " " . $row->p_name . " (" . $var_color . "" . $var_size . "" . $var_material . "" . $var_weight . " ) </option>";
	}
	return $str;
}
function get_item_details($id = 0)
{
	$result = DB::table('productitems')
		->join('products', 'productitems.p_id', '=', 'products.p_id')
		->join('variants', 'variants.var_id', '=', 'productitems.var_id')
		->select('products.*', 'productitems.*', 'variants.*')
		->where('productitems.item_id', $id)->first();
	return $result;
}
function  item_serial_number($id)
{
	$result = DB::table('product_serials')
		->where('product_serials.p_id', $id)
		->select('p_serial_current')->get();

	if (count($result)  > 0) {
		$p_serial_current = $result[0]->p_serial_current;
	}
	$data = explode('-', $p_serial_current);
	$return_num = $data[0] . '-' . $data[1] + 1;;
	DB::table('product_serials')
		->where('p_serial_current', $p_serial_current)
		->update(['p_serial_current' => $return_num]);
	return $return_num;
}
function date_dash($date)
{
	if ($date != "" && $date != '0000-00-00' && $date != '0000-00-00 00:00:00') {
		$date_ary = explode('-', $date);
		return $date_ary[2] . '/' . $date_ary[1] . '/' . $date_ary[0];
	} else {
		return FALSE;
	}
}
function date_slash($date)
{
	if ($date != "" && $date != '0000-00-00' && $date != '0000-00-00 00:00:00') {
		$date_ary = explode('/', $date);
		return $date_ary[2] . '-' . $date_ary[0] . '-' . $date_ary[1];
	} else {
		return FALSE;
	}
}
function date_view($date)
{
	if ($date != "" && $date != '0000-00-00' && $date != '0000-00-00 00:00:00') {
		$date = $date;
		$d = explode("-", $date);
		return date("d-M-Y", mktime(0, 0, 0, $d[1], $d[2], $d[0]));
	}
}
function purchase_refrence_number()
{
	$result = DB::table('counter')->select('pur_refrence_no')->get();

	if (count($result)  > 0) {
		$pur_refrence_no = $result[0]->pur_refrence_no;
	} else {
		$pur_refrence_no = 0;
		DB::table('counter')->insert(
			['pur_refrence_no' => $pur_refrence_no]
		);
	}
	$return_num = $pur_refrence_no + 1;
	DB::table('counter')
		->where('pur_refrence_no', $pur_refrence_no)
		->update(['pur_refrence_no' => $return_num]);
	return $return_num;
}
function stock_refrence_no()
{
	$result = DB::table('counter')->select('stock_refrence_no')->get();

	if (count($result)  > 0) {
		$stock_refrence_no = $result[0]->stock_refrence_no;
	} else {
		$stock_refrence_no = 0;
		DB::table('counter')->insert(
			['stock_refrence_no' => $stock_refrence_no]
		);
	}
	$return_num = $stock_refrence_no + 1;
	DB::table('counter')
		->where('stock_refrence_no', $stock_refrence_no)
		->update(['stock_refrence_no' => $return_num]);
	return $return_num;
}
function transfer_stock_from_warehousefrom_warehouseto($wh_id_from = 0, $wh_id_to = 0, $item_id = 0, $stock_qty = 0)
{
	$data = DB::table('stockdetails')
		->leftjoin('itemdetails', 'itemdetails.item_id', '=', 'stockdetails.item_id')
		->select('stockdetails.*', 'itemdetails.cost_per_unit')
		->where('stockdetails.item_id', '=', $item_id)
		->Where('stockdetails.wh_id', '=', $wh_id_from)
		->where("stockdetails.acc_id", "=", Session::get('acc_id'))
		->first();
	$old_qty = $data->stock_qty;
	$inhand_qty	 = $old_qty - $stock_qty;
	$cost_per_unit = $data->cost_per_unit;

	$result = DB::table('stockdetails')
		->where('wh_id', $wh_id_from)
		->where('item_id', $item_id)
		->update(
			array(
				'stock_qty' => $inhand_qty,
				'total_cost' => $inhand_qty * $cost_per_unit,
				'updated_at' => date('Y-m-d H:i:s')
			)
		);

	return $cost_per_unit;
}
function expense_category_dropdown($selected = 0)
{
	$reg_array = DB::table('expensecategories')
				->where("acc_id", "=", Session::get('acc_id'))
				->select('*')->get();
	$str = '<option value="">Select Expense Category</option>';
	foreach ($reg_array as $row) {
		$opt_selected = "";
		if ($selected == $row->exp_cat_id) {
			$opt_selected = "selected";
		}
		$str .= '<option value="' . $row->exp_cat_id . '" ' . $opt_selected . '>' . $row->exp_cat_title . '(' . $row->exp_cat_code . ')</option>';
	}
	return $str;
}
function get_expense_category_details($id = 0)
{
	$result = DB::table('expensecategories')->where('exp_cat_id', $id)->first();
	return $result;
}
function get_item_stockchargesdetails($id = 0)
{
	$result = DB::table('stockchargesdetails')->where('item_id', $id)->first();
	return $result;
}
function sales_invoice_no()
{
	$result = DB::table('counter')->select('sales_invoice_no')->get();

	if (count($result)  > 0) {
		$sales_invoice_no = $result[0]->sales_invoice_no;
	} else {
		$sales_invoice_no = 0;
		DB::table('counter')->insert(
			['sales_invoice_no' => $sales_invoice_no]
		);
	}
	$return_num = $sales_invoice_no + 1;
	DB::table('counter')
		->where('sales_invoice_no', $sales_invoice_no)
		->update(['sales_invoice_no' => $return_num]);
	return $return_num;
}
function calculate_item_profit_onsale($item_id = 0, $cost_per_unit = 0, $sale_price = 0)
{
	$result = DB::table('stockchargesdetails')
		->where('item_id', $item_id)
		->select('stockchargesdetails.amazon_fee')
		->first();

	$amazon_fee = $result->amazon_fee;

	$profit_on_product = ($sale_price - ($cost_per_unit + $amazon_fee));
	return $profit_on_product;
}
function get_purchase_documents($id)
{
	$result = DB::table('purchase_documents')->where('pur_id', $id)->get();
	return $result;
}