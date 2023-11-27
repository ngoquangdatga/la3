<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\PasswordReset;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function login()
    {
        return view('users.login');
    }

    public function create_account(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:10',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'city' => 'required|numeric|min:1',
                'district' => 'required|numeric|min:1',
                'ward' => 'required|numeric|min:1',
            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không hợp lệ',
                'min' => ':attribute không được nhỏ hơn :min',
                'max' => ':attribute không được lớn hơn :max',
                'numeric' => ':attribute không hợp lệ',
                'regex' => ':attribute không đúng',
            ],
            [
                'name' => 'Họ Tên',
                'phone' => 'Số Điện Thoại',
                'email' => 'Email',
                'password' => 'Mật Khẩu',
                'city' => 'Tỉnh/Thành phố',
                'district' => 'Quận/Huyện',
                'ward' => 'Xã/Phường',
            ]
        );

        if ($validator->passes()) {
            $users = new User();
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->phone = $request->input('phone');
            $users->password = bcrypt($request->input('password'));
            $users->address = $request->input('address');

            $users->save();

            return response()->json(['success'=>'Added new records.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function process_login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không hợp lệ',
                'min' => ':attribute không được nhỏ hơn :min',
            ],
            [
                'email' => 'Email',
                'password' => 'Mật Khẩu',
            ]
        );
        $users = $request->only('email', 'password');

        if(!$validator->errors()->all()){
            if(Auth::attempt($users))
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

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }

    public function forget_password(){
        return view('user.forget_password');
    }

    public function forget_password_post(Request $request){
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        $email = $request->email;

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $data = [
            'email' => $email,
            'token' => $token
        ];

        Mail::to($email)->send(new ResetPassword($data));

        return back()->with('message', 'Chúng tôi đã gửi link về email của bạn!');
    }

    public function reset_password($token){
        return view('user.reset_pwd_link', compact('token'));
    }

    public function reset_password_post(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|',
        ]);

        $email = $request->email;
        $token = $request->token;

        $updatePassword = PasswordReset::where([
            'email' => $email,
            'token' => $token
        ])->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Giá trị đang sai vui lòng thử lại');
        }

        $user = User::where('email', $email)
            ->update(['password' => Hash::make($request->password)]);

        PasswordReset::where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }


    /*
     * Login Admin
     */

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function login_admin()
    {
        return view('admin.login');
    }

    public function process_login_admin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:3',
            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không hợp lệ',
                'min' => ':attribute không được nhỏ hơn :min',
            ],
            [
                'email' => 'Email',
                'password' => 'Mật Khẩu',
            ]
        );

        if(!$validator->errors()->all()){
            $userName = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
            if($userName)
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

    public function logout_admin(Request $request)
    {
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            $this->guard()->logout();
            return redirect('/admin/index');
        }
    }
}
