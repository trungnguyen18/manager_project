@extends('layouts.admin')

@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập Nhật Vai trò
        </div>
        <div class="card-body">
            <form action="{{route('role_edit', $role->id)}}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên vai trò</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="display_name">Mô tả vai trò</label>
                        <textarea name="display_name" class="form-control" id="describe" id="" cols="30" rows="5"> {{$role->display_name}}</textarea>
                        @error('describe')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <label>
                        <input type="checkbox" class="checkAll">
                        Check All
                    </label>
                </div>
                @foreach ($permissionParent as $permissionParentItem)
                    <div class="card border-primary mb-3 col-md-12">
                        <div class="card-header" style="background:#1bce3c;">
                            <label for="">
                                <input type="checkbox" name="checkall" id="" class="checkbox_wrapper">
                            </label>
                            Module {{$permissionParentItem->name}}
                        </div>
                       <div class="row">
                            @foreach ($permissionParentItem->permissionChildrent as $permissionsChildrentItem)
                            <div class="card-body text-primary col-md-3">
                                <h5 class="card-title">
                                <label for="">
                                    <input type="checkbox" name="permission_id[]" {{$permissionsChecked->contains('id',$permissionsChildrentItem->id)?'checked':''}} value="{{$permissionsChildrentItem->id}}" class="checkbox_childrent">
                                </label>
                                {{$permissionsChildrentItem->name}}
                            </h5>
                            </div>
                            @endforeach
                        </div>     
                           
                    </div>
                @endforeach   
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection