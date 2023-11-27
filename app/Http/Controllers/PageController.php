<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Bill;
use App\BillDetail;
use App\Blog;
use App\Cart;
use App\Category;
use App\Mail\SendMail;
use App\Product;
use App\Review;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{

    public function index()
    {
        $products = Product::join('categories', 'categories.id', 'products.categories_id')
            ->orderBy('id', 'DESC')
            ->select('categories.name as category', 'categories.id as category_id', 'products.*')
            ->take(8)
            ->get();
        $category = Category::all();
        $banners = Banner::all();
        $blogs = Blog::take(3)->orderBy('id', 'DESC')->get();
        return view('user.index', compact('products', 'category', 'banners', 'blogs'));
    }

    public function product()
    {
        $search = '';
        if (isset($_GET['search'])) {
            $products = Product::join('categories', 'categories.id', 'products.categories_id')
                ->where('products.name', 'LIKE', '%' . $_GET['search'] . '%')
                ->orderBy('products.id', 'DESC')
                ->select('categories.name as category', 'categories.id as category_id', 'products.*')
                ->paginate(9);
            $search = $_GET['search'];
            $products->appends(['search' => $search]);
            //$search = $_GET['search'];
        } else {
            $products = Product::join('categories', 'categories.id', 'products.categories_id')
                ->orderBy('products.id', 'DESC')
                ->select('categories.name as category', 'categories.id as category_id', 'products.*')
                ->paginate(9);
        }

        $categories = Category::all();
        return view('user.products', compact('products', 'categories', 'search'));
    }

    public function product_detail($id)
    {
        $check_reviews = collect();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $check_reviews = Product::join('bill_details', 'products.id', 'bill_details.product_id')
                ->join('bills', 'bills.id', 'bill_details.bill_id')
                ->join('users', 'users.id', 'bills.user_id')
                ->where('products.id', $id)
                ->where('users.id', $user_id)
                ->select('products.id as id')
                ->get();
        }

        $reviews = Product::join('reviews', 'products.id', 'reviews.product_id')
            ->join('users', 'users.id', 'reviews.user_id')
            ->where('products.id', $id)
            ->select('users.id as id','users.name as name','reviews.id as review_id', 'reviews.rate', 'reviews.description', 'reviews.created_at')
            ->get();

        $products = Product::find($id);
        $count_review = Review::where('product_id', $products->id)->count();
        $name_cate = Category::where('id', $products->categories_id)->first();
        $related_products = Product::where('categories_id', $products->categories_id)->paginate(4);

        return view('user.product_detail', compact('products', 'related_products', 'name_cate', 'check_reviews', 'reviews', 'count_review'));
    }

    public function category($id)
    {
        $search = '';
        if (isset($_GET['search'])) {
            $products = Product::join('categories', 'categories.id', 'products.categories_id')
                ->where('products.categories_id', $id)
                ->where('products.name', 'LIKE', '%' . $_GET['search'] . '%')
                ->orderBy('products.created_at', 'DESC')
                ->select('categories.name as category', 'categories.id as category_id', 'products.*')
                ->paginate(9);
            $search = $_GET['search'];
            $products->appends(['search' => $search]);
        } else {
            $products = Product::join('categories', 'categories.id', 'products.categories_id')
                ->where('products.categories_id', $id)
                ->orderBy('products.created_at', 'DESC')
                ->select('categories.name as category', 'categories.id as category_id', 'products.*')
                ->paginate(9);
        }

        $categories = Category::all();
        return view('user.product_of_category', compact('products', 'categories', 'search', 'id'));
    }

    public static function cartItem()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            return Cart::where('user_id', $userId)->count();
        } else {
            return redirect('/login');
        }
    }

    public static function totalPrice()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $totals = Cart::join('products', 'products.id', 'carts.product_id')
                ->join('users', 'users.id', 'carts.user_id')
                ->where('carts.user_id', $userId)
                ->get(['carts.quantity', 'products.original_price', 'products.promotion_price']);

            $total = 0;

            foreach ($totals as $t) {
                if (!empty($t->promotion_price)) {
                    $total += $t->quantity * ($t->original_price - $t->original_price *($t->promotion_price/100));
                } else {
                    $total += $t->quantity * $t->original_price;
                }
            }
            return $total;
        } else {
            return redirect('/login');
        }

    }

    public static function check_cart($user_id, $product_id, $size, $color)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->where('size', $size)
                ->where('color', $color)
                ->first();
            if ($cart) {
                return $cart;
            } else {
                return 0;
            }
        } else {
            return redirect('/login');
        }
    }

    public function add_to_cart(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            $message = array();
            $size = $request->size;
            $color = $request->color;
            $qty = $request->quantity;

            if ($size == 'undefined') {
                $message[] = 'Kích thước không được để trống';
            }
            if ($color == 'undefined') {
                $message[] = 'Màu sắc không được để trống';
            }
            if ($qty <= 0) {
                $message[] = 'Số lượng không được bé hơn 1';
            }


            if (empty($message)) {
                $user_id = Auth::user()->id;
                $product_id = $request->input('product_id');
                $size = $request->input('size');
                $color = $request->input('color');

                $check_id = $this->check_cart($user_id, $product_id, $size, $color);

                if (!empty($check_id)) {
                    $cart_id = Cart::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->where('size', $size)
                        ->where('color', $color)
                        ->first()
                        ->id;
                    $cart = Cart::find($cart_id);
                    $cart->quantity = $cart->quantity + $request->input('quantity');

                    $cart->save();
                    if ($cart) {
                        return response()->json(['success' => 200]);
                    } else {
                        return response()->json(['success' => 201]);
                    }
                } else {
                    $cart = new Cart();
                    $cart->user_id = Auth::user()->id;
                    $cart->size = $request->input('size');
                    $cart->color = $request->input('color');
                    $cart->product_id = $request->input('product_id');
                    $cart->quantity = $request->input('quantity');

                    $cart->save();
                    if ($cart) {
                        return response()->json(['success' => 200]);
                    } else {
                        return response()->json(['success' => 201]);
                    }
                }
            } else {
                return response()->json(['error' => $message]);
            }

        } else {
            return response()->json(['success' => 302]);
        }
    }

    public function show_carts()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;

            $products = Cart::join('products', 'products.id', 'carts.product_id')
                ->join('users', 'users.id', 'carts.user_id')
                ->where('carts.user_id', $userId)
                ->get(['carts.quantity', 'carts.color', 'carts.size', 'carts.id as cart_id', 'products.id as id', 'products.name', 'products.original_price', 'products.promotion_price', 'products.avatar']);
//            dd($products);
//            exit();
            $totals = Cart::join('products', 'products.id', 'carts.product_id')
                ->join('users', 'users.id', 'carts.user_id')
                ->where('carts.user_id', $userId)
                ->get(['carts.quantity', 'products.original_price', 'products.promotion_price']);

            $total = 0;

            foreach ($totals as $t) {
                if (!empty($t->promotion_price)) {
                    $total += $t->quantity * ($t->original_price - $t->original_price *($t->promotion_price/100));
                } else {
                    $total += $t->quantity * $t->original_price;
                }
            }
            //dd($products);
            return view('user.shop_cart', compact('products', 'total'));
        } else {
            return redirect('/login');
        }
    }

    public function update_carts(Request $request)
    {
        if (Auth::check()) {
            //dd($request->all());
            $cart_id = $request->cart_id;
            $quantity = $request->quantity;

            for ($i = 0; $i < count($quantity); $i++) {
                $id = $cart_id[$i];
                $qty = $quantity[$i];

                $cart = Cart::find($id);
                $cart->quantity = $qty;
                $cart->save();
            }
            return redirect()->back();
        } else {
            return redirect('/login');
        }
    }

    public function remove_carts($id)
    {
        if (Auth::check()) {
            $cart = Cart::destroy($id);

            if ($cart) {
                return response()->json(['success' => 200]);
            } else {
                return response()->json(['success' => 201]);
            }
        } else {
            return redirect('/login');
        }

    }

    public function profile()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $users = User::find($user_id);

            return view('user.profile', compact('users'));
        } else {
            return redirect('/login');
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            $check_user = Auth::user();
            if($check_user->address == '' || $check_user->phone == ''){
                return view('user.update_info');
            }else{
                $users = Auth::user();
                $userId = Auth::user()->id;

                $products = Cart::join('products', 'products.id', 'carts.product_id')
                    ->join('users', 'users.id', 'carts.user_id')
                    ->where('carts.user_id', $userId)
                    ->get(['carts.quantity', 'products.name', 'products.original_price','products.promotion_price']);

                $totals = Cart::join('products', 'products.id', 'carts.product_id')
                    ->join('users', 'users.id', 'carts.user_id')
                    ->where('carts.user_id', $userId)
                    ->get(['carts.quantity', 'products.original_price','products.promotion_price']);

                $total = 0;

                foreach ($totals as $t) {
                    if (!empty($t->promotion_price)) {
                        $total += $t->quantity * ($t->original_price - $t->original_price *($t->promotion_price/100));
                    } else {
                        $total += $t->quantity * $t->original_price;
                    }
                }
                return view('user.checkout', compact('total', 'products', 'users'));
            }

        } else {
            return redirect('/login');
        }

    }

    public function order_status()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            if (isset($_GET['search'])) {
                $bills = Bill::join('users', 'users.id', 'bills.user_id')
                    ->orWhere('users.name', 'LIKE', '%' . $_GET['search'] . '%')
                    ->where('users.id', $user_id)
                    ->orderBy('bills.created_at', 'DESC')
                    ->select('bills.id as id', 'users.name', 'users.address', 'users.phone', 'status', 'total', 'bills.created_at')
                    ->paginate(4);
                $search = $_GET['search'];
                $bills->appends(['search' => $search]);
            } else {
                $bills = Bill::join('users', 'users.id', 'bills.user_id')
                    ->where('users.id', $user_id)
                    ->orderBy('bills.created_at', 'DESC')
                    ->select('bills.id as id', 'users.name', 'users.address', 'users.phone', 'status', 'total', 'bills.created_at')
                    ->paginate(4);
            }

            return view('user.order_status', compact('bills'));
        } else {
            return redirect('/login');
        }
    }

    public function detail_bill($id)
    {
        if (Auth::check()) {
            $bills = Bill::join('bill_details', 'bills.id', 'bill_details.bill_id')
                ->join('products', 'products.id', 'bill_details.product_id')
                ->where('bills.id', '=', $id)
                ->select('products.id as id','products.name as name_product', 'bill_details.quantity', 'bill_details.original_price', 'bill_details.size', 'bill_details.color')
                ->get();

            $customers = User::join('bills', 'bills.user_id', 'users.id')
                ->where('bills.id', '=', $id)
                ->select('bills.id as id','bills.status', 'users.name', 'users.address', 'users.email', 'users.phone', 'total')
                ->first();

            return view('user.bill_detail', compact('bills', 'customers'));
        } else {
            return redirect('/login');
        }
    }

    public function destroy_order_status($id){
        if (Auth::check()) {
            $bills = Bill::find($id);
            $bills->status = 'Đã hủy đơn';
            $bills->save();

            return redirect('order-status');
        } else {
            return redirect('/login');
        }
    }

    public function process_checkout(Request $request)
    {
        if (Auth::check()) {
//            dd($request->all());
//            exit();
            $validator = Validator::make(
                $request->all(),
                [
                    'note' => 'required',
                ],
                [
                    'required' => ':attribute không được để trống',
                ],
                [
                    'note' => 'Ghi chú',
                ]
            );
            if (!$validator->errors()->all()) {
                $user_id = Auth::user()->id;
                $carts = Cart::join('products', 'products.id', 'carts.product_id')
                    ->join('users', 'users.id', 'carts.user_id')
                    ->where('carts.user_id', $user_id)
                    ->get(['carts.id', 'carts.quantity', 'carts.product_id', 'carts.size', 'carts.color', 'products.original_price', 'products.promotion_price']);

                $total = 0.0;

                foreach ($carts as $t) {
                    if (!empty($t->promotion_price)) {
                        $total += $t->quantity * ($t->original_price - $t->original_price *($t->promotion_price/100));
                    } else {
                        $total += $t->quantity * $t->original_price;
                    }
                }


                $bill = new Bill();
                $bill->user_id = $user_id;
                $bill->date_order = date('Y-m-d');
                $bill->total = number_format($total, 1, '.', '');
                $bill->payment = 'no';
                $bill->note = $request->note;
                $bill->status = 'Đang xử lý';

                $bill->save();

                foreach ($carts as $cart) {
                    $bill_detail = new BillDetail();
                    $bill_detail->bill_id = $bill->id;
                    $bill_detail->product_id = $cart->product_id;
                    $bill_detail->quantity = $cart->quantity;
                    if (!empty($cart->promotion_price)) {
                        $bill_detail->original_price = $cart->original_price - $cart->original_price *($cart->promotion_price/100);
                    } else {
                        $bill_detail->original_price = $cart->original_price;
                    }
                    $bill_detail->size = $cart->size;
                    $bill_detail->color = $cart->color;
                    $bill_detail->save();

                    $products = Product::find($cart->product_id);
                    $products->quantity = $products->quantity - $cart->quantity;
                    $products->save();

                    $cart->delete($cart->id);
                }
                if ($carts) {
                    return response()->json(['success' => 200]);
                } else {
                    return response()->json(['success' => 201]);
                }

            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }

        } else {
            return redirect('/login');
        }
    }

    public function blog()
    {
        $blogs = Blog::paginate(12);
        $blogs_archive = Blog::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) as data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();

        return view('user.blog', compact('blogs', 'blogs_archive'));
    }

    public function blog_details($id)
    {
        $blogs = Blog::find($id);
        $categories = Category::all();
        $blogs_cate = Blog::where('categories_id', $blogs->categories_id)->take(3)->get();
        return view('user.blog_detail', compact('blogs', 'categories', 'blogs_cate'));
    }

    public function add_review(Request $request, $id)
    {
        //dd($request->all());
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            //dd($request->all());
            $reviews = new Review();
            $reviews->user_id = $user_id;
            $reviews->product_id = $id;
            $reviews->rate = $request->rating;
            $reviews->description = $request->description;

            $reviews->save();

            if ($reviews) {
                return response()->json(['success' => 200]);
            } else {
                return response()->json(['success' => 201]);
            }
        } else {
            return redirect('/login');
        }
    }

    public function delete_review($id){
        if (Auth::check()) {
            $result =  Review::destroy($id);
            if($result)
            {
                return response()->json(['success' => 200]);
            }
            else
            {
                return response()->json(['success' => 201]);
            }
        } else {
            return redirect('/login');
        }
    }

    public function change_pwd(Request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'password_old' => 'required|min:6',
                    'password_new' => 'required|min:6',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute không được nhỏ hơn :min',
                ],
                [
                    'password_old' => 'Mật khẩu cũ',
                    'password_new' => 'Mật khẩu mới',
                ]
            );

            if (!$validator->errors()->all()) {
                $data = $request->all();
                $password_old = Auth::User()->password;
                if (Hash::check($data['password_old'], $password_old)) {
                    //thay đổi mật khẩu
                    $user_id = Auth::User()->id;
                    $users = User::find($user_id);
                    $users->password = Hash::make($data['password_new']);
                    $users->save();

                    if ($users) {
                        return response()->json(['success' => 200]);
                    } else {
                        return response()->json(['success' => 201]);
                    }

                } else {
                    //vui lòng nhập lại mật khẩu cũ
                    return response()->json(['success' => 202, 'msg' => 'Vui lòng nhập lại mật khẩu cũ']);
                }
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        } else {
            return redirect('/login');
        }
    }

    public function send_contact(Request $request){
        $email = $request->email;
        $name = $request->name;
        $title = 'Liên hệ Shop Thời Trang';
        $body = $request->message;

        $data = [
            'name' => $name,
            'title' => $title,
            'body' => $body
        ];

        Mail::to($email)->send(new SendMail($data));
        return redirect()->back();
    }

    public function update_info(Request $request){
        if (Auth::check()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:10',
                    'city' => 'required|numeric|min:1',
                    'district' => 'required|numeric|min:1',
                    'ward' => 'required|numeric|min:1',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute không được nhỏ hơn :min',
                    'max' => ':attribute không được lớn hơn :max',
                    'numeric' => ':attribute không hợp lệ',
                    'regex' => ':attribute không đúng',
                ],
                [
                    'phone' => 'Số Điện Thoại',
                    'city' => 'Tỉnh/Thành phố',
                    'district' => 'Quận/Huyện',
                    'ward' => 'Xã/Phường',
                ]
            );

            if ($validator->passes()) {
                $users = User::find(Auth::id());
                $users->phone = $request->input('phone');
                $users->address = $request->input('address');

                $users->save();

                return response()->json(['success'=>'Added new records.']);
            }


            return response()->json(['error'=>$validator->errors()->all()]);

        } else {
            return redirect('/login');
        }
    }
}
