@extends('layouts.admin')

@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm Permission
        </div>
        <div class="card-body">
            <form action="{{route('permission_store')}}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name"><strong>Chọn module phân quyền</strong></label>
                        <select name="module_parent" class="form-control">
                            <option value="">Chọn module</option>
                            @foreach (config('permissions.table_module') as $moduleItem)                            
                            <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                            @endforeach

                        </select>
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">
                                <input type="checkbox" name="checkAll" class="checkall">
                                CheckAll
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (config('permissions.module_childrent') as $moduleItemChildrent)                           
                        <div class="col-md-3"><label for="{{$moduleItemChildrent}}"><input type="checkbox" id="{{$moduleItemChildrent}}" value="{{$moduleItemChildrent}}"
                            name="module_childrent[]" class="module_childrent"
                            > <strong>{{$moduleItemChildrent}}</strong></label></div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection