<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class AdminPermissionController extends Controller
{
    //
    public function createPermission(){
        return view('admin.permission.add');        
    }

    public function store(Request $request){
        $permission = Permission::create([
            'name' => $request->input('module_parent'),
            'display_name' => $request->input('module_parent'),
            'parent_id' => 0,
            'key_code' =>''
        ]);  

        foreach($request->module_childrent as $value){
            Permission::create([
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $permission->id,
                'key_code' => $request->module_parent. '_'.$value
            ]);
        }
        
    }
}
