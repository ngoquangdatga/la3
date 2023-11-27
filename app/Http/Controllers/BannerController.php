<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{

    public function index()
    {
        return view('admin.banner.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required',
                'images'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'required'               => ':attribute không được để trống',
                'mimes'                 => ':attribute phải là file jpeg,png,jpg,gif,svg'
            ],
            [
                'title' => 'Tiêu Đề',
                'images' => 'Hình Ảnh',
            ]
        );

        if (!$validator->errors()->all()){
            $banner = new Banner();
            $banner->title = $request->title;

            if($file = $request->file('images')){
                $images = 'banner-'.time().'.'.$file->getClientOriginalExtension();
                $file->move('../public/images/banner/', $images);
            }

            $banner->images = $images;

            $banner->save();
            if($banner)
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

    public function show()
    {
        if(isset($_GET['search'])){
            $banners = Banner::where('title', 'LIKE', '%'.$_GET['search'].'%')
            ->paginate(10);
            $search = $_GET['search'];
            $banners->appends(['search' => $search]);
        }else{
            $banners = Banner::paginate(10);
        }

        return view('admin.banner.show', compact('banners'));
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {

        if(Auth::guard('admin')->check())
        {
            if($request->file('images')){
                $validator = Validator::make(
                    $request->all(),
                    [
                        'title'     => 'required',
                        'images'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ],
                    [
                        'required'               => ':attribute không được để trống',
                        'mimes'                 => ':attribute phải là file jpeg,png,jpg,gif,svg'
                    ],
                    [
                        'title' => 'Tiêu Đề',
                        'images' => 'Hình Ảnh',
                    ]
                );
                if (!$validator->errors()->all()){

                    $banner = Banner::find($id);
                    $banner->title = $request->title;
                    if($file = $request->file('images')){
                        $images = 'banner-'.time().'.'.$file->getClientOriginalExtension();
                        $file->move('../public/images/banner/', $images);
                    }

                    $banner->images = $images;
                    $banner->save();
                    if($banner)
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

            }else{
                $validator = Validator::make(
                    $request->all(),
                    [
                        'title'     => 'required',
                        'images_hidden'            => 'required',
                    ],
                    [
                        'required'               => ':attribute không được để trống',
                    ],
                    [
                        'title' => 'Tiêu Đề',
                        'images_hidden' => 'Hình Ảnh',
                    ]
                );
                if (!$validator->errors()->all()){
                    $banner = Banner::find($id);
                    $banner->title = $request->title;

                    $banner->images = $request->images_hidden;
                    $banner->save();

                    if($banner)
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
        }
        else
        {
            return redirect('/admin/index');
        }
    }

    public function destroy($id){
        if(Auth::guard('admin')->check())
        {
            $result =  Banner::destroy($id);
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
}
