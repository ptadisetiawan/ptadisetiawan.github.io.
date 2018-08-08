@extends('layouts.admin.index')

@section('title')
Posts
@endsection('title')

@section('content')
<!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Post list</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Post list 
              <a onclick="addForm()" class="btn btn-primary float-right" style="margin-top: -8px; color:white;">Add Post</a>  
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="post-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="30">ID</th>
                      <th>Category</th>
                      <th>Title</th>
                      <th>Body</th>
                      <th>Photo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
@include('formpost')
@endsection('content')


@section('script')
<script type="text/javascript">
    var table = $('#post-table').DataTable({  
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('api.post') }}",
                    columns: [
                      {data: 'id', name: 'id'},
                      {data: 'category', name: 'category'},
                      {data: 'title', name: 'title'},
                      {data: 'body', name: 'body'},
                      {data: 'show_photo', name: 'show_photo'},
                      {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                  });

    function addForm() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form').modal('show');
      $('#modal-form form')[0].reset();
      $('.modal-title').text('Add Post');
    }

    function editForm(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#modal-form form')[0].reset();
      $.ajax({
        url: "{{ url('post') }}" + '/' + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#modal-form').modal('show');
          $('.modal-title').text('Edit Post');

          $('#id').val(data.id);
          $('#category_id').val(data.category_id);
          $('#propinsi_id').val(data.propinsi_id);
          $('#kabupaten_id').val(data.kabupaten_id);
          $('#kecamatan_id').val(data.kecamatan_id);
          $('#title').val(data.title);
          $('#body').val(data.body);
          
        },
        error : function() {
            alert("Nothing Data");
        }
      });
    }

    function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                url : "{{ url('post') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token},
                success : function(data) {
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: data.message,
                        type: 'success',
                        timer: '1500'
                    })
                },
                error : function () {
                    swal({
                        title: 'Oops...',
                        text: "Gagal",
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        });
      }

    $(function(){
          $('#modal-form form').validator().on('submit', function (e) {
              if (!e.isDefaultPrevented()){
                  var id = $('#id').val();
                  if (save_method == 'add') url = "{{ url('post') }}";
                  else url = "{{ url('post') . '/' }}" + id;
                  {{--  var a = $('#category_id').val();
                  var b = $('#propinsi_id').val();
                  var c = $('#kabupaten_id').val();
                  var d = $('#kecamatan_id').val();
                  var e = $('#title').val();
                  var f = $('#body').val();
                  console.log(a);
                  console.log(b);
                  console.log(c);
                  console.log(d);
                  console.log(e);
                  console.log(f);  --}}

                  $.ajax({
                      url : url,
                      type : "POST",
//                        data : $('#modal-form form').serialize(),
                      data: new FormData($("#modal-form form")[0]),
                      contentType: false,
                      processData: false,
                      success : function(data) {
                          $('#modal-form').modal('hide');
                          table.ajax.reload();
                          swal({
                              title: 'Success!',
                              text: data.message,
                              type: 'success',
                              timer: '1500'
                          })
                      },
                      error : function(data){
                          swal({
                              title: 'Oops...',
                              text: data.message,
                              type: 'error',
                              timer: '1500'
                          })
                      }
                  });
                  return false;
              }
          });
      });

      $(document).ready(function(){
          var cat=" ";
          var prop = " ";
          $.ajax({
              type:'get',
              url: '{!! URL::to('findcategory') !!}',
              data: '',
              success:function(data){

                  cat+='<option value="0" selected disabled>-- Pilih --</option>';
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

                  prop+='<option value="0" selected disabled>-- Pilih --</option>';
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
  
                      op+='<option value="0" selected disabled>-- Pilih --</option>';
                      for(var i=0; i<data.length; i++)
                      op+='<option value="'+data[i].id+'">'+data[i].kabupaten+'</option>';
  
                      $('#kabupaten_id').html(" ");
                      $('#kabupaten_id').append(op);
  
  
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
                      
                      op+='<option value="0" selected disabled>-- Pilih --</option>';
                      for(var i=0; i<data.length; i++)
                      op+='<option value="'+data[i].id+'">'+data[i].kecamatan+'</option>';
  
                      $('#kecamatan_id').html(" ");
                      $('#kecamatan_id').append(op);
  
  
                  },
                  error:function(){
                      console.log("error");
                  }
              });
          });
  
      });
  </script>

@endsection('script')

