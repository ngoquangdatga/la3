<?php

namespace App\Http\Controllers;

use App\Category;
use App\ImageProduct;
use App\Product;
use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function index(){
        if(Auth::guard('admin')->check())
        {
            $category = Category::all();

            return view('admin.product.index', compact('category'));
        }
        else
        {
            return redirect('/admin/index');
        }

    }

    public function show(){
        if(Auth::guard('admin')->check())
        {
            if(isset($_GET['search'])){
                $product = Product::join('categories', 'categories.id', 'products.categories_id')
                    ->where('products.name', 'LIKE','%'. $_GET['search'].'%')
                    ->select('categories.name as name_categories', 'products.*')->paginate(10);
                $search = $_GET['search'];
                $product->appends(['search' => $search]);
            }else{
                $product = Product::join('categories', 'categories.id', 'products.categories_id')
                    ->select('categories.name as name_categories', 'products.*')->paginate(10);
            }

            return view('admin.product.show', compact('product'));
        }
        else
        {
            return redirect('/admin/index');
        }

    }

    public function store(Request $request)
    {
        if(Auth::guard('admin')->check())
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'category'          => 'required',
                    'product'           => 'required',
                    'original_price'    => 'required|numeric|min:1',
                    'quantity'          => 'required|numeric|min:1',
                    'more_description'  => 'required',
                    'description'       => 'required',
                    'avatar'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'img1'              => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'img2'              => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'img3'              => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'required'          => ':attribute không được để trống',
                    'mimes'             => ':attribute phải là file jpeg,png,jpg,gif,svg',
                    'min'               => ':attribute không được nhỏ hơn :min',
                ],
                [
                    'category'          => 'Tên Danh Mục',
                    'product'           => 'Tên Sản Phẩm',
                    'original_price'    => 'Giá',
                    'quantity'          => 'Số Lượng',
                    'more_description'  => 'Mô Tả Thêm',
                    'description'       => 'Mô Tả',
                    'avatar'            => 'Ảnh đại diện',
                    'img1'              => 'Hình Ảnh 1',
                    'img2'              => 'Hình Ảnh 2',
                    'img3'              => 'Hình Ảnh 3',
                ]
            );

            if (!$validator->errors()->all()){
                $description=$request->input('description');
                $dom = new DomDocument();
                $dom->loadHtml('<?xml encoding="utf-8" ?>'.$description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $images = $dom->getElementsByTagName('img');

                foreach($images as $key => $img){
                    $data = $img->getAttribute('src');

                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);

                    $image_name= "../images/product/description/" . time().$key.'.png';
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }

                $description = $dom->saveHTML();

                $products = new Product();
                $products->name = $request->product;
                $products->original_price = $request->original_price;
                $products->promotion_price  = 0;
                $products->description = $description;
                $products->more_description = $request->more_description;
                $products->quantity = $request->quantity;
                $products->categories_id = $request->category;


                if($file = $request->file('avatar')){
                    $images = time().'-'.$file->getClientOriginalName();
                    $file->move('../public/images/product/', $images);
                }

                $products->avatar = $images;

                if($file = $request->file('img1')){
                    $images1 = time().rand(100, 9999).'.png';
                    $file->move('../public/images/product/', $images1);
                }
                $products->img1 = $images1;

                if($file = $request->file('img2')){
                    $images2 = time().rand(100, 9999).'.png';
                    $file->move('../public/images/product/', $images2);
                }
                $products->img2 = $images2;

                if($file = $request->file('img3')){
                    $images3 = time().rand(100, 9999).'.png';
                    $file->move('../public/images/product/', $images3);
                }
                $products->img3 = $images3;

                $products->save();

                if($products)
                {
                    return response()->json(['success' => 200]);
                }
                else
                {
                    return response()->json(['success' => 201]);
                }
            }else{
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
        else
        {
            return redirect('/admin/index');
        }
    }

    public function edit($id)
    {
        if(Auth::guard('admin')->check()) {
            $category = Category::all();

            $products = Product::find($id);
            $cate_product = Category::find($products->categories_id);

            return view('admin.product.edit', compact('products', 'category', 'cate_product'));
        }
        else
        {
            return redirect('/admin/index');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::guard('admin')->check())
        {
            if($request->file('avatar')){
                $validator = Validator::make(
                    $request->all(),
                    [
                        'category'          => 'required',
                        'product'           => 'required',
                        'original_price'    => 'required|numeric|min:1',
                        'quantity'          => 'required|numeric|min:1',
                        'more_description'  => 'required',
                        'description'       => 'required',
                        'avatar'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'img1'              => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'img2'              => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'img3'              => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ],
                    [
                        'required'          => ':attribute không được để trống',
                        'mimes'             => ':attribute phải là file jpeg,png,jpg,gif,svg',
                        'min'               => ':attribute không được nhỏ hơn :min',
                    ],
                    [
                        'category'          => 'Tên Danh Mục',
                        'product'           => 'Tên Sản Phẩm',
                        'original_price'    => 'Giá',
                        'quantity'          => 'Số Lượng',
                        'more_description'  => 'Mô Tả Thêm',
                        'description'       => 'Mô Tả',
                        'avatar'            => 'Ảnh đại diện',
                        'img1'              => 'Hình Ảnh 1',
                        'img2'              => 'Hình Ảnh 2',
                        'img3'              => 'Hình Ảnh 3',
                    ]
                );
                if (!$validator->errors()->all()){
                    $description=$request->input('description');
                    $dom = new DomDocument();
                    @$dom->loadHtml('<?xml encoding="UTF-8">'.$description);
                    libxml_use_internal_errors(true);

                    $images = $dom->getelementsbytagname('img');
                    $bs64='base64';

                    foreach($images as $k => $img){
                        $data = $img->getattribute('src');
                        if (strpos($data,$bs64) == true)
                        {
                            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                            $image_name = "../images/product/description/". 'post_' . time() . $k . '.png';
                            $path = public_path() . $image_name;
                            file_put_contents($path, $data);
                            $img->removeAttribute('src');
                            $img->setAttribute('src', $image_name);
                        }
                        else
                        {
                            $image_name="".$data;
                            $img->setAttribute('src', $image_name);
                        }
                    }

                    $description = $dom->saveHTML();

                    $products = Product::find($id);
                    $products->name = $request->input('product');
                    $products->original_price = $request->input('original_price');
                    $original_price = $request->input('original_price');
                    $promotion_price = $request->input('promotion_price');
//                    $products->promotion_price  = (float)$original_price * ((100 - $promotion_price)/100);
                    $products->promotion_price  = $promotion_price;
                    $products->description = $description;
                    $products->more_description = $request->input('more_description');
                    $products->quantity = $request->input('quantity');
                    $products->categories_id = $request->input('category');

                    if($request->file('avatar')){
                        if($file = $request->file('avatar')){
                            $images = 'avatar'.time().'.png';
                            $file->move('../public/images/product/', $images);
                        }
                        $products->avatar = $images;
                    }
                    if($request->file('img1')){
                        if($file = $request->file('img1')){
                            $images = 'img1'.time().'.png';
                            $file->move('../public/images/product/', $images);
                        }
                        $products->img1 = $images;
                    }
                    if($request->file('img2')){
                        if($file = $request->file('img2')){
                            $images = 'img2'.time().'.png';
                            $file->move('../public/images/product/', $images);
                        }
                        $products->img2 = $images;
                    }
                    if($request->file('img3')){
                        if($file = $request->file('img3')){
                            $images = 'img3'.time().'.png';
                            $file->move('../public/images/product/', $images);
                        }
                        $products->img3 = $images;
                    }

                    $products->save();

                    if($products)
                    {
                        return response()->json(['success' => 200]);
                    }
                    else
                    {
                        return response()->json(['success' => 201]);
                    }
                }
                else{
                    return response()->json(['error'=>$validator->errors()->all()]);
                }
            }else{
                $validator = Validator::make(
                    $request->all(),
                    [
                        'category'          => 'required',
                        'product'           => 'required',
                        'original_price'    => 'required|numeric|min:1',
                        'quantity'          => 'required|numeric|min:1',
                        'more_description'  => 'required',
                        'description'       => 'required',
                        'avatar_hidden'     => 'required',
                        'img1_hidden'       => 'required',
                        'img2_hidden'       => 'required',
                        'img3_hidden'       => 'required',
                    ],
                    [
                        'required'          => ':attribute không được để trống',
                        'min'               => ':attribute không được nhỏ hơn :min',
                    ],
                    [
                        'category'          => 'Tên Danh Mục',
                        'product'           => 'Tên Sản Phẩm',
                        'original_price'    => 'Giá',
                        'quantity'          => 'Số Lượng',
                        'more_description'  => 'Mô Tả Thêm',
                        'description'       => 'Mô Tả',
                        'avatar'            => 'Ảnh đại diện',
                        'img1_hidden'       => 'Hình Ảnh 1',
                        'img2_hidden'       => 'Hình Ảnh 2',
                        'img3_hidden'       => 'Hình Ảnh 3',

                    ]
                );
                if (!$validator->errors()->all()){
                    $description=$request->input('description');
                    $dom = new DomDocument();
                    @$dom->loadHtml('<?xml encoding="UTF-8">'.$description);
                    libxml_use_internal_errors(true);

                    $images = $dom->getelementsbytagname('img');
                    $bs64='base64';

                    foreach($images as $k => $img){
                        $data = $img->getattribute('src');
                        if (strpos($data,$bs64) == true)
                        {
                            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                            $image_name = "../images/product/description/". 'post_' . time() . $k . '.png';
                            $path = public_path() . $image_name;
                            file_put_contents($path, $data);
                            $img->removeAttribute('src');
                            $img->setAttribute('src', $image_name);
                        }
                        else
                        {
                            $image_name="".$data;
                            $img->setAttribute('src', $image_name);
                        }
                    }

                    $description = $dom->saveHTML();

                    $products = Product::find($id);
                    $products->name = $request->input('product');
                    $products->original_price = (float)$request->input('original_price');
                    $original_price = $request->input('original_price');
                    $promotion_price = $request->input('promotion_price');
                    $products->promotion_price  = $promotion_price;
                    $products->description = $description;
                    $products->more_description = $request->input('more_description');
                    $products->quantity = $request->input('quantity');
                    $products->categories_id = $request->input('category');
                    $products->avatar = $request->avatar_hidden;
                    $products->img1 = $request->img1_hidden;
                    $products->img2 = $request->img2_hidden;
                    $products->img3 = $request->img3_hidden;

                    $products->save();

                    if($products)
                    {
                        return response()->json(['success' => 200]);
                    }
                    else
                    {
                        return response()->json(['success' => 201]);
                    }
                }
                else{
                    return response()->json(['error'=>$validator->errors()->all()]);
                }
            }
        }
        else
        {
            return redirect('/admin/index');
        }
    }

    public function destroy($id){
        if(Auth::guard('admin')->check())
        {
            $result =  Product::destroy($id);
            if($result)
            {
                return response()->json(['success' => 200]);
            }
            else
            {
                return response()->json(['success' => 201]);
            }
        }
        else
        {
            return redirect('/admin/index');
        }
    }

//    Done
}
