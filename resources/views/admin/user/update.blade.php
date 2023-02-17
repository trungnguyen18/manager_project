@extends('layouts.admin')

@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập Nhật người dùng
        </div>
        <div class="card-body">
            <form action="{{route('user_edit',$user->id)}}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{$user->password}}">
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label><br>
                        @foreach ($roles as $item)
                            <input type="checkbox" name="role_id[]" id="{{$item->name}}" value="{{$item->id}}" style="margin-right: 5px"
                            {{$roleOfuser->contains('id',$item->id)?"checked":""}}
                            ><label for="{{$item->name}}">{{ $item->display_name}}</label>
                        |
                        @endforeach
                </div>
                <button type="submit" class="btn btn-primary" name="btn_update" value="Cập Nhật">Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection