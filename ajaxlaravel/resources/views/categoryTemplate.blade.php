@extends('layouts.admin.index')


@section('title')
Category
@endsection('title')
@section('content')
<!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Category list</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Category list 
              <a onclick="addForm()" class="btn btn-primary float-right" style="margin-top: -8px; color:white;">Add Post</a>  
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="category-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="30">ID</th>
                      <th>Category</th>
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
@include('formcategory')
@endsection('content')

@section('script')
    <script type="text/javascript">
        var table = $('#category-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('api.category') }}",
                        columns: [
                          {data: 'id', name: 'id'},
                          {data: 'category', name: 'category'},
                          {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                      });
  
        function addForm() {
          save_method = "add";
          $('input[name=_method]').val('POST');
          $('#modal-form').modal('show');
          $('#modal-form form')[0].reset();
          $('.modal-title').text('Add Category');
        }
  
        function editForm(id) {
          save_method = 'edit';
          $('input[name=_method]').val('PATCH');
          $('#modal-form form')[0].reset();
          $.ajax({
            url: "{{ url('category') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
              $('#modal-form').modal('show');
              $('.modal-title').text('Edit Category');
  
              $('#id').val(data.id);
              $('#category').val(data.category);
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
                    url : "{{ url('category') }}" + '/' + id,
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
                            text: data.message,
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
                      if (save_method == 'add') url = "{{ url('category') }}";
                      else url = "{{ url('category') . '/' }}" + id;
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
      </script>
@endsection('script')
