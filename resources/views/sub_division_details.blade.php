{{-- this whole page will be sent to ajax for the modal body --}}
<input type="hidden" id="sub_div_code_edit" name="sub_div_code_edit" value="{{ $sub_division_data[0]->sub_div_code }}">
<div class="form-group row">
    <label for="districtName" class="col-sm-2 col-form-label">District</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="sub_div_dist_edit" name="sub_div_dist_edit"
            value="{{ trim($sub_division_data[0]->district->dist_name) }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="districtHeadquarter" class="col-sm-2 col-form-label">Sub Division</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="sub_div_name_edit" name="sub_div_name_edit"
            value="{{ trim($sub_division_data[0]->sub_div_name) }}">
    </div>
</div>
<div class="form-group row">
    <label for="districtActive" class="col-sm-2 col-form-label">Active</label>
    <div class="col-sm-4">
        <select class="form-control custom-select" id="active_edit_sub_div" name="active_edit_sub_div">
            <option value="Y" {{ trim($sub_division_data[0]->display) == 'Y' ? 'selected' : '' }}>Yes
            </option>
            <option value="N" {{ trim($sub_division_data[0]->display) == 'N' ? 'selected' : '' }}>No
            </option>
        </select>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn_sub_div_update').prop('disabled', true);
        $('#sub_div_name_edit').keyup(function() {
            if ($(this).val()) {
                $('#btn_sub_div_update').prop('disabled', false);
            }
        });

        $('#active_edit_sub_div').change(function() {
            if ($(this).val()) {
                $('#btn_sub_div_update').prop('disabled', false);
            }
        });
    });
</script>
