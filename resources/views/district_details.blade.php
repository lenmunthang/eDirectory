{{-- this whole page will be sent to ajax for the modal body --}}
<input type="hidden" id="dist_code_edit" name="dist_code_edit" value="{{ $updateDistrictShow[0]->dist_code }}">
<div class="form-group row">
    <label for="districtName" class="col-sm-2 col-form-label">District Name</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="dist_name_edit" name="dist_name_edit"
            value="{{ trim($updateDistrictShow[0]->dist_name) }}" required>
    </div>
</div>
<div class="form-group row">
    <label for="districtHeadquarter" class="col-sm-2 col-form-label">Headquarter</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="dist_head_edit" name="dist_head_edit"
            value="{{ trim($updateDistrictShow[0]->dist_headquarter) }}">
    </div>
</div>
<div class="form-group row">
    <label for="districtActive" class="col-sm-2 col-form-label">Active</label>
    <div class="col-sm-4">
        <select class="form-control custom-select" id="active_edit" name="active_edit">
            <option value="Y" {{ trim($updateDistrictShow[0]->display) == 'Y' ? 'selected' : '' }}>Yes
            </option>
            <option value="N" {{ trim($updateDistrictShow[0]->display) == 'N' ? 'selected' : '' }}>No
            </option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="districtImage" class="col-sm-2 col-form-label">District Image</label>
    <div class="col-sm-4">
        <img src="{{ $updateDistrictShow[0]->dist_img ? asset(trim($updateDistrictShow[0]->dist_img)) : asset('assets/images/users/1.jpg') }}"
            alt="District Photo" class="img-fluid mb-2" style="width: 200px; height: 200px;"
            id="preview-image-before-upload-edit">
        <input type="file" class="form-control-file" id="dist_img_edit" name="dist_img_edit" accept="image/*">
        <div id="image-upload-error-edit" class="text-danger"></div>
        <input type="hidden" class="form-control" id="dist_img_edit_val" name="dist_img_edit_val"
            value="{{ trim($updateDistrictShow[0]->dist_img) }}">
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn_dist_update').prop('disabled', true);
        $('#dist_name_edit, #dist_head_edit, #active_edit').keyup(function() {
            if ($(this).val()) {
                $('#btn_dist_update').prop('disabled', false);
            }
        });

        $('#active_edit').change(function() {
            if ($(this).val()) {
                $('#btn_dist_update').prop('disabled', false);
            }
        });

        $('#dist_img_edit').on('change', function() {
            // var img_src = $("#dist_img_edit_val").val();
            let file = this.files[0];
            let fileType = file['type'];
            let validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if ($.inArray(fileType, validImageTypes) < 0) {
                // show error message
                $('#image-upload-error-edit').html(
                    'Invalid image type. Please select a JPG/JPEG, PNG or GIF file.');
                // reset the file input
                $('#dist_img_edit').val('');
                $('#btn_dist_update').prop('disabled', true);
                // clear the preview image
                // $('#preview-image-before-upload-edit').attr('src', img_src);
            } else {
                // clear the error message
                $('#btn_dist_update').prop('disabled', false);
                $('#image-upload-error-edit').html('');
                // display the preview image
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload-edit').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }

        });
    });
</script>
