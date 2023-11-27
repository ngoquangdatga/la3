<?php

namespace App\Http\Controllers;


use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        if(isset($_GET['search'])){
            $users = User::orWhere('name', 'LIKE','%'. $_GET['search'].'%')
                ->orWhere('email', 'LIKE','%'. $_GET['search'].'%')
                ->orWhere('phone', 'LIKE','%'. $_GET['search'].'%')
            ->paginate(10);
            $search = $_GET['search'];
            $users->appends(['search'], $search);
        }else{
            $users = User::paginate(10);
        }

        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {


        if(Auth::guard('admin')->check())
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'name'              => 'required',
                    'email'             => 'required|email',
                ],
                [
                    'required'          => ':attribute không được để trống',
                    'email'             => ':attribute không hợp lệ',
                ],
                [
                    'name'              => 'Tên Khách Hàng',
                    'email'             => 'Gmail',

                ]
            );
            if(!$validator->errors()->all()){
                $user = User::find($id);
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->save();

                if($user)
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

    public function destroy($id)
    {
        if(Auth::guard('admin')->check())
        {
            $result =  User::destroy($id);
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

    //Done

}
