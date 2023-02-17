<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use App\Role;
class AdminRoleController extends Controller
{
    //
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function list(){
        $roles = $this->role->paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    public function create(){
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        // dd($permission);
        return view('admin.role.add', compact('permissionParent'));
    }

    public function store(Request $request){
        $role = $this->role->create([
            'name' => $request->name,
            'display_name'=>$request->display_name
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect('admin/role/list')->with('status','Đã thêm thành công!');
    }

    public function update($id){
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
        // dd($permissionsChecked);
        return view('admin.role.update', compact('permissionParent','role','permissionsChecked'));
    }

    public function edit(Request $request, $id){
        $this->role->find($id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name
        ]);
        $role = $this->role->find($id);
        $role->permissions()->sync($request->permission_id);
        return redirect('admin/role/list')->with('status', 'Đã cập nhật thành công!');
    }

    public function delete($id){
        $role = $this->role->find($id);
        $role->delete();
        return redirect('admin/role/list')->with('status', 'Bạn đã xóa thành công!');
    }

   
}
