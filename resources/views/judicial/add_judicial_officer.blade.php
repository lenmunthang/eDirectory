@extends('index')
@section('content')
    <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Add New Judicial Officer</h4>
            <h6 class="card-subtitle"></h6>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include('flash')

            <form id="jo-form" method="POST" action="{{ route('store_judicial_officer') }}" class="m-t-40"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h3>Profile</h3>
                    <section>
                        <div class="form-group row">
                            <label for="jo_status" class="col-sm-2 control-label col-form-label">Officer's Status *</label>
                            <div class="col-sm-10">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="jo_status" id="active_jo"
                                        value="Y" checked>
                                    <label class="form-check-label" for="active_jo">Active</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="jo_status" id="inactive_jo"
                                        value="N">
                                    <label class="form-check-label" for="inactive_jo">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jo_fname" class="col-sm-2 control-label col-form-label">Officer's First Name
                                *</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select id="jo_initials" name="jo_initials" class="form-control">
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>&nbsp;
                                    <input type="text" class="required form-control" name="jo_fname" id="jo_fname"
                                        placeholder="First Name Here">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jo_mname" class="col-sm-2 control-label col-form-label">Officer's Middle
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jo_mname" id="jo_mname"
                                    placeholder="Middle Name Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_lname" class="col-sm-2 control-label col-form-label">Officer's Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jo_lname" id="jo_lname"
                                    placeholder="Last Name Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_full_name" class="col-sm-2 control-label col-form-label">Officer's Full
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jo_full_name" id="jo_full_name" readonly>
                            </div>
                        </div>

                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Upload Photo</h3>
                    <section>
                        <div id="image-upload-error" class="text-danger"></div>
                        <img src="{{ asset('assets/images/users/1.jpg') }}" alt="Profile Photo" class="img-fluid mb-2"
                            style="width: 300px; height: 300px;" id="preview-image-before-upload">
                        <div class="form-group">
                            <label for="profile-photo">Upload Photo</label>
                            <input type="file" class="form-control-file" id="jo_image" name="jo_image" accept="image/*">
                        </div>
                    </section>
                    <h3>Details</h3>
                    <section>
                        <div class="form-group row">
                            <label for="jo_grade" class="col-sm-3 control-label col-form-label">Officer's Grade *</label>
                            <div class="col-sm-8">
                                <select id="jo_grade" name="jo_grade" class="required select form-control custom-select">
                                    <option value="">Select Grade</option>
                                    <option value="1">Grade - I</option>
                                    <option value="2">Grade - II</option>
                                    <option value="3">Grade - III</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_priority" class="col-sm-3 control-label col-form-label">Judicial Officer's
                                Priority</label>
                            <div class="col-sm-8">
                                <input id="jo_priority" name="jo_priority" type="text" class=" form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_code" class="col-sm-3 control-label col-form-label">Judicial Officer's
                                Code</label>
                            <div class="col-sm-8">
                                <input id="jo_code" name="jo_code" type="text" class=" form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_desg" class="col-sm-3 control-label col-form-label">Judicial Officer's
                                Designation *</label>
                            <div class="col-sm-8">
                                <input id="jo_desg" name="jo_desg" type="text" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_mslsa" class="col-sm-3 control-label col-form-label">Meghalays State Legal
                                Services Authority</label>
                            <div class="col-sm-8">
                                <input id="jo_mslsa" name="jo_mslsa" type="checkbox" value="mslsa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_msja" class="col-sm-3 control-label col-form-label">Meghalays State Judicial
                                Academy</label>
                            <div class="col-sm-8">
                                <input id="jo_msja" name="jo_msja" type="checkbox" value="msja">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Place of Posting *</label>
                            <div class="col-sm-8">
                                <select id="jo_pop_district" name="jo_pop_district[]"
                                    class="required select2 form-control" multiple="multiple"
                                    style="height: 36px;width: 100%;">
                                    @foreach ($pop as $dist)
                                        <optgroup label="{{ $dist->dist_name }}">
                                            <option value="{{ $dist->dist_code }}">{{ $dist->dist_headquarter }}
                                            </option>
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Sub-Division</label>
                            <div class="col-sm-8">
                                <select id="jo_pop_sub_div" name="jo_pop_sub_div[]" class="select2 form-control"
                                    multiple="multiple" style="height: 36px;width: 100%;">
                                    @foreach ($pop_sub_div as $subdiv)
                                        <option value="{{ $subdiv->sub_div_code }}">{{ $subdiv->sub_div_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jo_dob" class="col-sm-3 control-label col-form-label">Date of Birth *</label>
                            <div class="col-sm-8">
                                <input id="jo_dob" name="jo_dob" type="date" class="required form-control"
                                    onfocus="this.showPicker()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jo_qual" class="col-sm-3 control-label col-form-label">Education Qualification
                                *</label>
                            <div class="col-sm-8">
                                <input id="jo_qual" name="jo_qual" type="text" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dt_appt" class="col-sm-3 control-label col-form-label">Date of
                                Apppointment</label>
                            <div class="col-sm-8">
                                <input id="dt_appt" name="dt_appt" type="date" class=" form-control"
                                    onfocus="this.showPicker()">
                            </div>
                        </div>
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Contact</h3>
                    <section>
                        <div class="form-group row">
                            <label for="telephone" class="col-sm-2 control-label col-form-label">Telephone Number</label>
                            <div class="col-sm-8">
                                <input id="telephone" name="telephone" type="text" class=" form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-sm-2 control-label col-form-label">Fax Number</label>
                            <div class="col-sm-8">
                                <input id="fax" name="fax" type="text" class=" form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-2 control-label col-form-label">Mobile Number</label>
                            <div class="col-sm-8">
                                <input id="mobile" name="mobile" type="text" class=" form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label col-form-label">Email ID</label>
                            <div class="col-sm-8">
                                <input id="email" name="email" type="text" class=" form-control">
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customjs')
    @include('scripts.jo_js')
@endsection
