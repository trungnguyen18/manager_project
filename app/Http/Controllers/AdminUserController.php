<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    //
    private $user;
   private $role;
   public function __construct(Role $role, User $user)
   {
       $this->role = $role;
       $this->user = $user;
   }
    public function index(){
        $users = $this->user->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function add(){
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    } 

    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'string', 'min:8'],
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự ',
                // 'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu'
            ]
        );
        try{
           
            DB::beginTransaction();
        $user = $this->user->create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=> Hash::make($request->password),

                ]);
                $roleIds = $request->role_id;
                foreach($roleIds as $role){
                    DB::table('role_user')->insert([
                        'role_id' => $role,
                        'user_id' => $user->id
                    ]);
                }

                $user->roles()->attach($request->role_id);
                DB::commit();
                return redirect('admin/user/list')->with('status','Đã thêm thành công!');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error("message : ".$exception->getMessage() . '--- Line: '.$exception->getLine());
        }    
    }

    public function update($id){
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $roleOfuser = $user->roles;
        // dd($roleOfuser);
        return view('admin.user.update', compact('user','roles','roleOfuser'));
    }

    public function edit(Request $request,$id){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => ['required', 'string', 'min:8'],
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự ',
                // 'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu'
            ]
        );
        try{
           
            DB::beginTransaction();
            $this->user->find($id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=> Hash::make($request->password),

                ]);
                $user = $this->user->find($id);
                $user->roles()->sync($request->role_id);
                DB::commit();
                return redirect('admin/user/list')->with('status','Đã Cập Nhật thành công!');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error("message : ".$exception->getMessage() . '--- Line: '.$exception->getLine());
        }    
    }

    public function delete($id){
        if(Auth::id()!=$id){
            $user = $this->user->find($id);
            $user->delete();
            return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành công!');
        }else{
            return redirect('admin/user/list')->with('status', 'Bạn không thể xóa chính mình ra khỏi hệ thống!');
        }
    } 
}
