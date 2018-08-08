@extends('layouts.content.index')

@section('title')
Post Search
@endsection('title')

@section('content')
<h1 class="my-4">Search 
    <small>a post</small>
  </h1>

  

  <!-- Blog Post -->
  <div class="card mb-4">
   
    <div class="card-body">
            <form class="form-inline">

                    <select name="category_id" id="category_id" class="form-control" >
                            <option value="">Category</option>
                    </select>

                    <select name="propinsi_id" id="propinsi_id" class="form-control" >
                            <option value="">Propinsi</option>
                    </select>

                    <select name="kabupaten_id" id="kabupaten_id" class="form-control" >
                            <option value="">Kabupaten</option>
                    </select>

                    <select name="kecamatan_id" id="kecamatan_id" class="form-control" >
                            <option value="">Kecamatan</option>
                    </select>
            </form>
    </div>


  <!-- Blog Post -->
  <div class="card mb-4" id="looping">
    <p class="text-center">loading...</p>
  </div>

</div>
@endsection('content')

@section('script')
  <script>
  $(document).ready(function(){
    var cat=" ";
    var prop = " ";
    $.ajax({
        type:'get',
        url: '{!! URL::to('findcategory') !!}',
        data: '',
        success:function(data){

            cat+='<option value="0" selected disabled>Category</option>';
            for(var i=0; i<data.length; i++)
            cat+='<option value="'+data[i].id+'">'+data[i].category+'</option>';

            $('#category_id').html(" ");
            $('#category_id').append(cat);


        },
        error:function(){
            console.log("error");
        }
    });



    $.ajax({
        type:'get',
        url: '{!! URL::to('findpropinsi') !!}',
        data: '',
        success:function(data){

            prop+='<option value="0" selected disabled>Propinsi</option>';
            for(var i=0; i<data.length; i++)
            prop+='<option value="'+data[i].id+'">'+data[i].propinsi+'</option>';

            $('#propinsi_id').html(" ");
            $('#propinsi_id').append(prop);


        },
        error:function(){
            console.log("error");
        }
    });

    $(document).on('change', '#propinsi_id', function(){
    
        var propinsi_id = $(this).val();
        var op=" ";
            $.ajax({
            type:'get',
            url: '{!! URL::to('findkabupaten') !!}',
            data:{'id':propinsi_id},
            success:function(data){

                op+='<option value="0" selected disabled>Kabupaten</option>';
                for(var i=0; i<data.length; i++)
                op+='<option value="'+data[i].id+'">'+data[i].kabupaten+'</option>';

                $('#kabupaten_id').html(" ");
                $('#kabupaten_id').append(op);
                $.ajax({
                    type:'get',
                    url: '{!! URL::to('findpostbypropinsi') !!}'+'/'+ propinsi_id,
                    data:{'id':propinsi_id},
                    success:function(data){
                        var jml = data.length;
                        var p = "";
                        if (jml > 0){
                            for (var i=0; i<jml; i++){
                                var link = "{{ url('post') }}" +"/"+data[i].id;
                                p+='<div class="card-body"><h2 class="card-title" id="title">'+data[i].title+'</h2><p class="card-text" id="body">'+ data[i].body +'</p><a href="'+link+'" class="btn btn-primary" id="readmore">Read More &rarr;</a></div><div class="card-footer text-muted">Posted on January 1, 2017 by<a href="#">Start Bootstrap</a></div>';
                                $('#looping').html("");
                                $('#looping').append(p);
                            }
                        }else{
                            p+= '<h4 class="text-center">Tidak ada data</h4>';
                            $('#looping').html("");
                            $('#looping').append(p);
                        }
                        
                        

                    },
                    error:function(){
                        console.log("error");
                    }
                });
            },
            error:function(){
                console.log("error");
            }
        });
        
    });

    $(document).on('change', '#kabupaten_id', function(){
        
        var kabupaten_id = $(this).val();
        var op=" ";
        $.ajax({
            type:'get',
            url: '{!! URL::to('findkecamatan') !!}',
            data:{'id':kabupaten_id},
            success:function(data){
                
                op+='<option value="0" selected disabled>Kecamatan</option>';
                for(var i=0; i<data.length; i++)
                op+='<option value="'+data[i].id+'">'+data[i].kecamatan+'</option>';

                $('#kecamatan_id').html(" ");
                $('#kecamatan_id').append(op);
                $.ajax({
                    type:'get',
                    url: '{!! URL::to('findpostbykabupaten') !!}'+'/'+ kabupaten_id,
                    data:{'id':kabupaten_id},
                    success:function(data){
                        var jml = data.length;
                        var p = "";
                        if (jml > 0){
                            for (var i=0; i<jml; i++){
                                var link = "{{ url('post') }}" +"/"+data[i].id;
                                p+='<div class="card-body"><h2 class="card-title" id="title">'+data[i].title+'</h2><p class="card-text" id="body">'+ data[i].body +'</p><a href="'+link+'" class="btn btn-primary" id="readmore">Read More &rarr;</a></div><div class="card-footer text-muted">Posted on January 1, 2017 by<a href="#">Start Bootstrap</a></div>';
                                $('#looping').html("");
                                $('#looping').append(p);
                            }
                        }else{
                            p+= '<h4 class="text-center">Tidak ada data</h4>';
                            $('#looping').html("");
                            $('#looping').append(p);
                        }
                    },
                    error:function(){
                        console.log("error");
                    }
                });


            },
            error:function(){
                console.log("error");
            }
        });
    });
    $(document).on('change', '#kecamatan_id', function(){
        
        var kecamatan_id = $(this).val();
        
                $.ajax({
                    type:'get',
                    url: '{!! URL::to('findpostbykecamatan') !!}'+'/'+ kecamatan_id,
                    data:{'id':kecamatan_id},
                    success:function(data){
                        var jml = data.length;
                        var p = "";
                        if (jml > 0){
                            for (var i=0; i<jml; i++){
                                var link = "{{ url('post') }}" +"/"+data[i].id;
                                p+='<div class="card-body"><h2 class="card-title" id="title">'+data[i].title+'</h2><p class="card-text" id="body">'+ data[i].body +'</p><a href="'+link+'" class="btn btn-primary" id="readmore">Read More &rarr;</a></div><div class="card-footer text-muted">Posted on January 1, 2017 by<a href="#">Start Bootstrap</a></div>';
                                $('#looping').html("");
                                $('#looping').append(p);
                            }
                        }else{
                            p+= '<h4 class="text-center">Tidak ada data</h4>';
                            $('#looping').html("");
                            $('#looping').append(p);
                        }
                    },
                    error:function(){
                        console.log("error");
                    }
                });
        });


        $(document).on('change', '#category_id', function(){
        
            var category_id = $(this).val();
            
                    $.ajax({
                        type:'get',
                        url: '{!! URL::to('findpostbycategory') !!}'+'/'+ category_id,
                        data:{'id':category_id},
                        success:function(data){
                            var jml = data.length;
                            var p = "";
                            if (jml > 0){
                                for (var i=0; i<jml; i++){
                                    var link = "{{ url('post') }}" +"/"+data[i].id;
                                    p+='<div class="card-body"><h2 class="card-title" id="title">'+data[i].title+'</h2><p class="card-text" id="body">'+ data[i].body +'</p><a href="'+link+'" class="btn btn-primary" id="readmore">Read More &rarr;</a></div><div class="card-footer text-muted">Posted on January 1, 2017 by<a href="#">Start Bootstrap</a></div>';
                                    $('#looping').html("");
                                    $('#looping').append(p);
                                }
                            }else{
                                p+= '<h4 class="text-center">Tidak ada data</h4>';
                                $('#looping').html("");
                                $('#looping').append(p);
                            }
                        },
                        error:function(){
                            console.log("error");
                        }
                    });
            });
 });
</script>
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
                console.log("error");
            }
        });
        });
</script>
 
<script>
        $(document).ready(function(){
            $.ajax({
                type:'get',
                url: '{!! URL::to('allpost') !!}',
                success:function(data){
                    var jml = data.length;
                    var p = "";
                    if (jml > 0){
                        for (var i=0; i<jml; i++){
                            var link = "{{ url('post') }}" +"/"+data[i].id;
                            p+='<div class="card-body"><h2 class="card-title" id="title">'+data[i].title+'</h2><p class="card-text" id="body">'+ data[i].body +'</p><a href="'+link+'" class="btn btn-primary" id="readmore">Read More &rarr;</a></div><div class="card-footer text-muted">Posted on January 1, 2017 by<a href="#">Start Bootstrap</a></div>';
                            $('#looping').html("");
                            $('#looping').append(p);
                        }
                    }else{
                        p+= '<h4 class="text-center">Tidak ada data</h4>';
                        $('#looping').html("");
                        $('#looping').append(p);
                    }
                },
                error:function(){
                    console.log("error");
                }
            });
         });
</script>
@endsection('script')