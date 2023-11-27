<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Repositories\BlogRepository;
use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function index()
    {
        $category = Category::all();
        return view('admin.blog.index', compact('category'));
    }

    public function show()
    {
        if(isset($_GET['search'])){
            $blogs = Blog::where('title','LIKE','%'.$_GET['search'].'%')
            ->paginate(10);
            $search = $_GET['search'];
            $blogs->appends(['search' => $search]);
        }else{
            $blogs = Blog::paginate(10);
        }
        return view('admin.blog.show', compact('blogs'));
    }

    public function store(Request $request)
    {
        if(Auth::guard('admin')->check())
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'category'     => 'required',
                    'title'     => 'required',
                    'content'     => 'required',
                    'images'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'required'               => ':attribute không được để trống',
                    'mimes'                 => ':attribute phải là file jpeg,png,jpg,gif,svg'
                ],
                [
                    'category'     => 'Danh Mục',
                    'title'         => 'Tiêu Đề',
                    'content'     => 'Mô Tả',
                    'images'            => 'Hình Ảnh',
                ]
            );

            if (!$validator->errors()->all()){

                $content = $request->input('content');
                $dom = new DomDocument();
                @$dom->loadHtml('<?xml encoding="UTF-8">'.$content);
                libxml_use_internal_errors(true);

                $images = $dom->getelementsbytagname('img');
                $bs64='base64';//variable to check the image is base64 or not

                foreach($images as $k => $img){
                    $data = $img->getattribute('src');
                    if (strpos($data,$bs64) == true)//if the Image is base 64
                    {
                        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                        $image_name = "../public/images/blog/description/". 'post_' . time() . $k . '.png';
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

                $content = $dom->saveHTML();

                $blog = new Blog();
                $blog->categories_id = $request->input('category');
                $blog->title = $request->input('title');
                $blog->content = $content;
                if($file = $request->file('images')){
                    $images = time().'-'.$file->getClientOriginalName();
                    $file->move('../public/images/blog/', $images);
                }
                $blog->images = $images;

                $blog->save();

                if($blog)
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
        $category = Category::all();
        $blogs = Blog::find($id);
        $category_id = Category::find($blogs->categories_id);
        return view('admin.blog.edit', compact('blogs', 'category_id', 'category'));
    }

    public function update(Request $request, $id)
    {
        if(Auth::guard('admin')->check())
        {
            if($request->file('images')){
                $validator = Validator::make(
                    $request->all(),
                    [
                        'category'     => 'required',
                        'title'     => 'required',
                        'content'     => 'required',
                        'images'            => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ],
                    [
                        'required'               => ':attribute không được để trống',
                        'mimes'                 => ':attribute phải là file jpeg,png,jpg,gif,svg'
                    ],
                    [
                        'category'     => 'Danh Mục',
                        'title'         => 'Tiêu Đề',
                        'content'     => 'Mô Tả',
                        'images'            => 'Hình Ảnh',
                    ]
                );
                if (!$validator->errors()->all()){
                    $content = $request->input('content');
                    $dom = new DomDocument();
                    @$dom->loadHtml('<?xml encoding="UTF-8">'.$content);
                    libxml_use_internal_errors(true);

                    $images = $dom->getelementsbytagname('img');
                    $bs64='base64';//variable to check the image is base64 or not

                    foreach($images as $k => $img){
                        $data = $img->getattribute('src');
                        if (strpos($data,$bs64) == true)//if the Image is base 64
                        {
                            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                            $image_name = "../public/images/blog/description/". 'post_' . time() . $k . '.png';
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

                    $content = $dom->saveHTML();

                    $blog = Blog::find($id);
                    $blog->categories_id = $request->input('category');
                    $blog->title = $request->input('title');
                    $blog->content = $content;

                    if($request->file('images')){
                        if($file = $request->file('images')){
                            $images = time().'-'.$file->getClientOriginalName();
                            $file->move('../public/images/blog/', $images);
                        }
                        $blog->images = $images;
                    }else{
                        $blog->images = $request->images_hidden;
                    }

                    $blog->save();

                    if($blog)
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
                        'category'     => 'required',
                        'title'     => 'required',
                        'content'     => 'required',
                        'images_hidden'   => 'required',
                    ],
                    [
                        'required'               => ':attribute không được để trống',
                    ],
                    [
                        'category'     => 'Danh Mục',
                        'title'         => 'Tiêu Đề',
                        'content'     => 'Mô Tả',
                        'images_hidden'            => 'Hình Ảnh',
                    ]
                );
                if (!$validator->errors()->all()){
                    $content = $request->input('content');
                    $dom = new DomDocument();
                    @$dom->loadHtml('<?xml encoding="UTF-8">'.$content);
                    libxml_use_internal_errors(true);

                    $images = $dom->getelementsbytagname('img');
                    $bs64='base64';//variable to check the image is base64 or not

                    foreach($images as $k => $img){
                        $data = $img->getattribute('src');
                        if (strpos($data,$bs64) == true)//if the Image is base 64
                        {
                            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
                            $image_name = "../public/images/blog/description/". 'post_' . time() . $k . '.png';
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

                    $content = $dom->saveHTML();

                    $blog = Blog::find($id);
                    $blog->categories_id = $request->input('category');
                    $blog->title = $request->input('title');
                    $blog->content = $content;

                    $blog->images = $request->images_hidden;

                    $blog->save();
                    if($blog)
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
            $result =  Blog::destroy($id);
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
