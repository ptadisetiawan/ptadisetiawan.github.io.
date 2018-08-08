@extends('layouts.content.index')

@section('title')
Home
@endsection('title')

@section('content')
<h1 class="my-4">Post
  <small></small>
</h1>


@foreach($posts as $post)

<!-- Blog Post -->
<div class="card mb-4">
  @if($post->photo !== NULL)
  <img class="card-img-top" src="{{$post->photo}}" alt="Card image cap">
  @endif
  <div class="card-body">
    <h2 class="card-title">{{$post->title}}</h2>
    <p class="card-text">{{str_limit($post->body, 100)}}</p>
    <a href="{{route('post.show', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
  </div>
  <div class="card-footer text-muted">
    Posted on January 1, 2017 by
    <a href="#">Start Bootstrap</a>
  </div>
</div>
@endforeach

@endsection('content')


@section('script')

  <script>
    $(document).ready(function(){

      var cat ="";
      $.ajax({
        type:'get',
        url: '{!! URL::to('findcategory') !!}',
        data: '',
        success:function(data){

            for(var i=0; i<data.length; i++)
            cat+='<li><a href="/postcategory/'+data[i].id+'">'+ data[i].category +'</a></li>';

            $('#listcat').html(" ");
            $('#listcat').append(cat);
        },
        error:function(){
            {{--  console.log("error");  --}}
        }
    });
    });
  </script>
@endsection('script')