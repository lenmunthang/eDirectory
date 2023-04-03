@extends('index')
@section('content')
    <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Add New Judge</h4>
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

            <form id="judge-form" method="POST" action="{{ route('store_judge') }}" class="m-t-40"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h3>Profile</h3>
                    <section>
                        <div class="form-group row">
                            <label for="judge_status" class="col-sm-2 control-label col-form-label">Judge's Status *</label>
                            <div class="col-sm-10">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="judge_status" id="active_judge"
                                        value="active" checked>
                                    <label class="form-check-label" for="active_jo">Active</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="judge_status" id="inactive_judge"
                                        value="inactive">
                                    <label class="form-check-label" for="inactive_jo">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jo_fname" class="col-sm-2 control-label col-form-label">Judge's First Name *</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select id="judge_initials" name="judge_initials" class="form-control">
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>&nbsp;
                                    <input type="text" class="required form-control" name="judge_f_name"
                                        id="judge_f_name" placeholder="First Name Here">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="JudgeMiddleName" class="col-sm-2 control-label col-form-label">Judge's Middle
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judge_m_name" id="judge_m_name"
                                    placeholder="Middle Name Here">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="JudgeLastName" class="col-sm-2 control-label col-form-label">Judge's Last
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judge_l_name" id="judge_l_name"
                                    placeholder="Last Name Here">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="JudgeFullName" class="col-sm-2 control-label col-form-label">Judge's Full
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judge_full_name" id="judge_full_name"
                                    readonly>
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
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        </div>
                        <div id="progress-bar"></div>
                    </section>
                    <h3>Details</h3>
                    <section>
                        <div class="form-group row">
                            <label for="judge_dob" class="col-sm-3 control-label col-form-label">Date of Birth *</label>
                            <div class="col-sm-8">
                                <input id="judge_dob" name="judge_dob" type="date" class="required form-control"
                                    onfocus="this.showPicker()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judge_qual" class="col-sm-3 control-label col-form-label">Education Qualification
                                *</label>
                            <div class="col-sm-8">
                                <input id="judge_qual" name="judge_qual" type="text" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dt_enroll" class="col-sm-3 control-label col-form-label">Date of Enrollment
                                *</label>
                            <div class="col-sm-8">
                                <input id="dt_enroll" name="dt_enroll" type="date" class="required form-control"
                                    onfocus="this.showPicker()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dt_ele" class="col-sm-3 control-label col-form-label">Date of Elevation</label>
                            <div class="col-sm-8">
                                <input id="dt_ele" name="dt_ele" type="date" class=" form-control"
                                    onfocus="this.showPicker()">
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
                        <div class="form-group row">
                            <label for="judge_desg" class="col-sm-3 control-label col-form-label">Judge
                                Designation</label>
                            <div class="col-sm-8">
                                <select id="judge_desg" name="judge_desg" class="select2 form-control custom-select"
                                    style="width: 100%; height:36px;">
                                    @if ($judge_seniority->count() > 0)
                                        <option disabled>Chief Justice - 1</option>
                                    @else
                                        <option value="1">Chief Justice - 1</option>
                                    @endif
                                    <option value="2">Acting Chief Justice - 2</option>
                                    <option value="3">Senior Judge - 3</option>
                                    <option value="4">Second Senior Judge - 4</option>
                                    <option value="5">Third Senior Judge - 5</option>
                                    <option value="6">Fourth Senior Judge - 6</option>
                                    <option value="7">Fifth Senior Judge - 7</option>
                                    <option value="8">Sixth Senior Judge - 8</option>
                                    <option value="9">Seventh Senior Judge - 9</option>
                                    <option value="10">Eighth Senior Judge - 10</option>
                                    <option value="11">Ninth Senior Judge - 11</option>
                                    <option value="12">Tenth Senior Judge - 12</option>
                                </select>
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
    @include('scripts.judge_js')
@endsection
