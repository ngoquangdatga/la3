<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Product;
use App\Repositories\AdminRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        if(Auth::guard('admin')->check()){
            $total = Bill::where('status','!=', 'Đã hủy đơn')->sum('total');
            $count_users = User::count();
            $count_products = Product::count();
            $pending_request = Bill::where('status', '=', 'Đang xử lý')->count();

            $bills = User::join('bills', 'bills.user_id', 'users.id')
                ->where('bills.status', '=', 'Đang xử lý')
                ->orderBy('bills.created_at', 'DESC')
                ->select('bills.id as id', 'users.name', 'users.address','users.phone', 'total', 'status' , 'bills.created_at')
                ->take(5)
                ->get();

            //$products = Product::where('quantity', '<', 10)->get();
            $products = Product::where('quantity', '<=', 10)->orderBy('products.created_at', 'DESC')->take(5)->get();

            return view('admin.home', compact('total', 'count_users', 'count_products', 'pending_request', 'bills', 'products'));
        }
        else
        {
            return redirect('/admin/index');
        }

    }

    public function statistic()
    {
        if(Auth::guard('admin')->check()){
            $bills = collect();
            $total = 0;
            $count_total_product = 0;
            $count_category_product = collect();


            if(isset($_POST['start_date']) && isset($_POST['end_date']))
            {
                $start_date = $_POST['start_date'];
                $end_date = date('Y-m-d H:i:s', strtotime($_POST['end_date'] . ' +1 day'));

                $bills = User::join('bills', 'bills.user_id', 'users.id')
                    ->where('status','!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->select('bills.id', 'users.name','users.phone', 'total', 'bills.created_at')
                    ->get();

                $total = Bill::where('status','!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->sum('total');

                $count_total_product = BillDetail::where('bill_details.created_at', '>=', $start_date)
                    ->where('bill_details.created_at', '<=', $end_date)
                    ->count();
                $count_category_product = BillDetail::join('products', 'products.id', 'bill_details.product_id')
                    ->join('categories', 'categories.id', 'products.categories_id')
                    ->where('bill_details.created_at', '>=', $start_date)
                    ->where('bill_details.created_at', '<=', $end_date)
                    ->selectRaw('categories.name as name,products.categories_id, count(*) as total')
                    ->groupBy('products.categories_id', 'categories.name')
                    ->get();

                $total_product = BillDetail::where('bill_details.created_at', '>=', $start_date)
                    ->where('bill_details.created_at', '<=', $end_date)
                    ->sum('quantity');

                $total_user = Bill::where('status', '!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->count();
                $total_all = Bill::where('status', '!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->sum('total');
            }else{
                //$dateComponents = getdate();
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d', strtotime('+1 days'));
//                dd($start_date, $end_date);
//                exit();

                $bills = User::join('bills', 'bills.user_id', 'users.id')
                    ->where('status','!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->select('bills.id', 'users.name','users.phone', 'total', 'bills.created_at')
                    ->get();

                $total = Bill::where('status','!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->sum('total');

                $count_total_product = BillDetail::where('bill_details.created_at', '>=', $start_date)
                    ->where('bill_details.created_at', '<=', $end_date)
                    ->count();
                $count_category_product = BillDetail::join('products', 'products.id', 'bill_details.product_id')
                    ->join('categories', 'categories.id', 'products.categories_id')
                    ->where('bill_details.created_at', '>=', $start_date)
                    ->where('bill_details.created_at', '<=', $end_date)
                    ->selectRaw('categories.name as name,products.categories_id, count(*) as total')
                    ->groupBy('products.categories_id', 'categories.name')
                    ->get();

                $total_product = BillDetail::where('bill_details.created_at', '>=', $start_date)
                    ->where('bill_details.created_at', '<=', $end_date)
                    ->sum('quantity');

                $total_user = Bill::where('status', '!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->count();

                $total_all = Bill::where('status', '!=', 'Đã hủy đơn')
                    ->where('bills.created_at', '>=', $start_date)
                    ->where('bills.created_at', '<=', $end_date)
                    ->sum('total');

            }


            return view('admin.statistic.show', compact('bills', 'total', 'count_total_product', 'count_category_product', 'total_product', 'total_user', 'total_all'));
        }
        else
        {
            return redirect('/admin/index');
        }
    }

}
