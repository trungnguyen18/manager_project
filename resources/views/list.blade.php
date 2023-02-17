<h1>Danh sách bài viết</h1>

@foreach ($posts as $item)
    <p><a href="{{route('post.show',$item->id)}}">{{$item->title}}</a></p>
@endforeach