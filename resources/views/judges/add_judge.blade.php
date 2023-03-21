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
                        <div class="form-group">
                            <label for="judge_status">Judge Status *</label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="judge_status" id="active_judge"
                                    value="active" checked>
                                <label class="form-check-label" for="active_judge">Active</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="judge_status" id="inactive_judge"
                                    value="inactive">
                                <label class="form-check-label" for="inactive_judge">Inactive</label>
                            </div>
                        </div>
                        <label for="JudgeFirstName">Judge First Name *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select id="judge_initials" name="judge_initials" class="required form-control">
                                    <option value="Mr">Mr.</option>
                                    <option value="Mrs">Mrs.</option>
                                    <option value="Ms">Ms.</option>
                                </select>
                            </div>&nbsp;
                            <input id="judge_f_name" name="judge_f_name" type="text" class="required form-control">
                        </div>
                        <label for="JudgeMiddleName">Judge Middle Name</label>
                        <input id="judge_m_name" name="judge_m_name" type="text" class="form-control">
                        <label for="JudgeLastName">Judge Last Name</label>
                        <input id="judge_l_name" name="judge_l_name" type="text" class=" form-control">
                        <label for="JudgeFullName">Judge Full Name</label>
                        <input id="judge_full_name" name="judge_full_name" type="text" class="form-control" readonly>
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Upload Photo</h3>
                    <section>
                        {{-- <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="img_upload"> --}}
                        <div id="image-upload-error" class="text-danger"></div>
                        <img src="{{ asset('assets/images/users/1.jpg') }}" alt="Profile Photo" class="img-fluid mb-2"
                            style="width: 300px; height: 300px;" id="preview-image-before-upload">
                        <div class="form-group">
                            <label for="profile-photo">Upload Photo</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        </div>
                        <div id="progress-bar"></div>
                        {{-- <input type="button" class="btn btn-primary" id="btn_img_upload" name="btn_img_upload" value="Upload"> --}}
                        {{-- </form> --}}
                    </section>
                    <h3>Details</h3>
                    <section>
                        <label for="judge_dob">Date of Birth *</label>
                        <input id="judge_dob" name="judge_dob" type="date" class="required form-control" onfocus="this.showPicker()">
                        <label for="judge_qual">Education Qualification *</label>
                        <input id="judge_qual" name="judge_qual" type="text" class="required form-control">
                        <label for="dt_enroll">Date of Enrollment *</label>
                        <input id="dt_enroll" name="dt_enroll" type="date" class="required form-control" onfocus="this.showPicker()">
                        <label for="dt_ele">Date of Elevation</label>
                        <input id="dt_ele" name="dt_ele" type="date" class=" form-control" onfocus="this.showPicker()">
                        <label for="dt_appt">Date of Apppointment</label>
                        <input id="dt_appt" name="dt_appt" type="date" class=" form-control" onfocus="this.showPicker()">
                        <label for="judge_desg">Judge Designation</label>
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
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Contact</h3>
                    <section>
                        <label for="telephone">Telephone Number</label>
                        <input id="telephone" name="telephone" type="text" class=" form-control">
                        <label for="fax">Fax Number</label>
                        <input id="fax" name="fax" type="text" class=" form-control">
                        <label for="mobile">Mobile Number</label>
                        <input id="mobile" name="mobile" type="text" class=" form-control">
                        <label for="email">Email ID</label>
                        <input id="email" name="email" type="text" class=" email form-control">
                    </section>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customjs')
    @include('scripts.judge_js')
@endsection
