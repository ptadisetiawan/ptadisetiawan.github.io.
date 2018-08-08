<div class="modal fade bd-example-modal-lg" id="modal-form" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                   
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="name" class="control-label">Category</label>
                        <div>
                            {{--  <input type="text" id="category_id" name="category_id" class="form-control" autofocus required>  --}}
                            <select name="category_id" id="category_id" class="form-control" required autofocus>
                                <option value="">-- Pilih --</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Propinsi</label>
                        <div>
                            <select name="propinsi_id" id="propinsi_id" class="form-control" required>
                                <option value="">-- Pilih --</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Kabupaten</label>
                        <div>
                            <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                                <option value="">-- Pilih --</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Kecamatan</label>
                        <div>
                            <select name="kecamatan_id" id="kecamatan_id" class="form-control" required>
                                <option value="">-- Pilih --</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="email" class="control-label">Title</label>
                      <div>
                          <input type="text" id="title" name="title" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">Body</label>
                        <div>
                            <textarea name="body" id="body" cols="30" rows="10" required class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo" class="control-label">Photo</label>
                        <div>
                            <input type="file" id="photo" name="photo" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
