<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Customer;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(){
        if(isset($_GET['search'])){
            $bills = User::join('bills', 'bills.user_id', 'users.id')
                ->orWhere('users.name', 'LIKE','%'. $_GET['search'].'%')
                ->orWhere('users.address', 'LIKE','%'. $_GET['search'].'%')
                ->orWhere('users.phone', 'LIKE','%'. $_GET['search'].'%')
                ->orderBy('bills.created_at', 'DESC')
                ->select('bills.id as id', 'users.name', 'users.address','users.phone','status', 'total' , 'bills.created_at')
                ->paginate(10);
            $search = $_GET['search'];
            $bills->appends(['search' => $search]);
        }else{
            $bills = User::join('bills', 'bills.user_id', 'users.id')
                ->orderBy('bills.created_at', 'DESC')
                ->select('bills.id as id', 'users.name', 'users.address','users.phone','status', 'total' , 'bills.created_at')
                ->paginate(10);
        }

        return view('admin.bill.index', compact('bills'));
    }

    public function bill_detail($id)
    {
        $customers = User::join('bills','bills.user_id', 'users.id')
            ->where('bills.id', '=', $id)
            ->select('users.name', 'users.address', 'users.email','users.phone', 'total')
            ->first();

        $bills = Bill::join('bill_details', 'bills.id', 'bill_details.bill_id')
            ->join('products', 'products.id','bill_details.product_id')
            ->where('bills.id', '=', $id)
            ->select('products.name as name_product', 'bill_details.quantity', 'bill_details.original_price', 'bill_details.size', 'bill_details.color')
            ->get();

        return view('admin.bill.bill_detail', compact('customers', 'bills'));
    }

    public function update_bill(Request $request, $id)
    {
        $bills = Bill::find($id);
        $bills->status = $request->status;

        $bills->save();

        return redirect()->back();
    }
}
