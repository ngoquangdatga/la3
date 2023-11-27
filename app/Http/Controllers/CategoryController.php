<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function index(){
        if(Auth::guard('admin')->check())
        {
            return view('admin.category.index');
        }
        else
        {
            return redirect('/admin/index');
        }

    }

    public function store(Request $request){
        if(Auth::guard('admin')->check())
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'name_category'     => 'required',
                    'images'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'required'               => ':attribute không được để trống',
                    'mimes'                 => ':attribute phải là file jpeg,png,jpg,gif,svg'
                ],
                [
                    'name_category' => 'Tên Danh Mục',
                    'images' => 'Hình Ảnh',
                ]
            );

            if (!$validator->errors()->all()) {
                $categories = new Category();
                $categories->name = $request->input('name_category');
                if($file = $request->file('images')){
                    $images = time().'-'.$file->getClientOriginalName();
                    $file->move('../public/images/category/', $images);
                }
                $categories->images = $images;

                $categories->save();

                if($categories)
                {
                    return response()->json(['success' => 200]);
                }
                else
                {
                    return response()->json(['success' => 201]);
                }
            } else {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
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
                $category = Category::where('name', 'LIKE','%'. $_GET['search'].'%')
                ->paginate(10);
                $search = $_GET['search'];
                $category->appends(['search' => $search]);
            }else{
                $category = Category::paginate(10);
            }

            return view('admin.category.show', compact('category'));
        }
        else
        {
            return redirect('/admin/index');
        }

    }

    public function edit($id){
        if(Auth::guard('admin')->check())
        {
            $category = Category::find($id);
            return view('admin.category.edit', compact('category'));
        }
        else
        {
            return redirect('/admin/index');
        }
    }

    public function update(Request $request, $id){
        if(Auth::guard('admin')->check())
        {
            if($request->file('images')){
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name_category'     => 'required',
                        'images'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ],
                    [
                        'required'               => ':attribute không được để trống',
                        'mimes'                 => ':attribute phải là file jpeg,png,jpg,gif,svg'
                    ],
                    [
                        'name_category' => 'Tên Danh Mục',
                        'images' => 'Hình Ảnh',
                    ]
                );
                if (!$validator->errors()->all()){
                    $categories = Category::find($id);
                    $categories->name = $request->input('name_category');
                    if($file = $request->file('images')){
                        $images = time().'-'.$file->getClientOriginalName();
                        $file->move('../public/images/category/', $images);
                    }
                    $categories->images = $images;
                    $categories->save();

                    if($categories)
                    {
                        return response()->json(['success' => 200]);
                    }
                    else
                    {
                        return response()->json(['success' => 201]);
                    }
                }else {
                    return response()->json(['error'=>$validator->errors()->all()]);
                }
            }else{
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name_category'     => 'required',
                        'images_hidden'     => 'required',
                    ],
                    [
                        'required'               => ':attribute không được để trống',
                    ],
                    [
                        'name_category' => 'Tên Danh Mục',
                        'images_hidden' => 'Hình Ảnh',
                    ]
                );
                if (!$validator->errors()->all()){
                    $categories = Category::find($id);
                    $categories->name = $request->name_category;
                    $categories->images = $request->images_hidden;
                    $categories->save();

                    if($categories)
                    {
                        return response()->json(['success' => 200]);
                    }
                    else
                    {
                        return response()->json(['success' => 201]);
                    }
                }else {
                    return response()->json(['error'=>$validator->errors()->all()]);
                }

            }
        }

    }

    public function destroy($id){
        if(Auth::guard('admin')->check())
        {
            $result =  Category::destroy($id);
            try{

                if($result)
                {
                    return response()->json(['success' => 200]);
                }
                else
                {
                    return response()->json(['success' => 201]);
                }
            }catch (Exception $e){
                return response()->json([
                    'success' => 404,
                    'message' => 'Vẫn còn liên kết giữa các bảng con'
                ]);
            }
        }
        else
        {
            return redirect('/admin/index');
        }
    }

    //Done
}
