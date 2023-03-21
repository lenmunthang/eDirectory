@extends('index')
@section('content')
    <div class="card">
        <div class="card-body wizard-content">            
            <h4 class="card-title">Update Judge</h4>
            <a href="{{url()->previous()}}" class="card-title btn btn-sm btn-secondary float-right">Back</a>            
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
                                    value="active" {{ $updateJudgeShow[0]->jd_display == 'Y' ? 'checked' : '' }}>
                                <label class="form-check-label" for="active_judge">Active</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="judge_status" id="inactive_judge"
                                    value="inactive" {{ $updateJudgeShow[0]->jd_display == 'N' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inactive_judge">Inactive</label>
                            </div>
                        </div>
                        <label for="JudgeFirstName">Judge First Name *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select id="judge_initials" name="judge_initials" class="required form-control">
                                    <option value="Mr"
                                        {{ trim($updateJudgeShow[0]->jd_title) == 'Mr' ? 'selected' : '' }}>Mr.</option>
                                    <option value="Mrs"
                                        {{ trim($updateJudgeShow[0]->jd_title) == 'Mrs' ? 'selected' : '' }}>Mrs.</option>
                                    <option value="Ms"
                                        {{ trim($updateJudgeShow[0]->jd_title) == 'Ms' ? 'selected' : '' }}>Ms.</option>
                                </select>
                            </div>&nbsp;
                            <input id="judge_f_name" name="judge_f_name" type="text" class="required form-control" value="{{ trim($updateJudgeShow[0]->jd_first_name) }}">
                        </div>
                        <label for="JudgeMiddleName">Judge Middle Name</label>
                        <input id="judge_m_name" name="judge_m_name" type="text" class="form-control" value="{{ trim($updateJudgeShow[0]->jd_middle_name) }}">
                        <label for="JudgeLastName">Judge Last Name</label>
                        <input id="judge_l_name" name="judge_l_name" type="text" class=" form-control" value="{{ trim($updateJudgeShow[0]->jd_last_name) }}">
                        <label for="JudgeFullName">Judge Full Name</label>
                        <input id="judge_full_name" name="judge_full_name" type="text" class="form-control"
                            value="{{ $updateJudgeShow[0]->jd_name }}" readonly>
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Upload Photo</h3>
                    <section>
                        <div id="image-upload-error" class="text-danger"></div>
                        <img src="{{ $updateJudgeShow[0]->jd_photo ? asset(trim($updateJudgeShow[0]->jd_photo)) : asset('assets/images/users/1.jpg') }}" alt="Profile Photo"
                            class="img-fluid mb-2" style="width: 300px; height: 300px;" id="preview-image-before-upload">
                        <div class="form-group">
                            <label for="profile-photo">Upload Photo</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </section>
                    <h3>Details</h3>
                    <section>
                        <label for="judge_dob">Date of Birth *</label>
                        <input id="judge_dob" name="judge_dob" type="date" class="required form-control"
                            value="{{ trim($updateJudgeShow[0]->jd_dob) }}">
                        <label for="judge_qual">Education Qualification *</label>
                        <input id="judge_qual" name="judge_qual" type="text" class="required form-control"
                            value="{{ trim($updateJudgeShow[0]->jd_qual) }}">
                        <label for="dt_enroll">Date of Enrollment *</label>
                        <input id="dt_enroll" name="dt_enroll" type="date" class="required form-control"
                            value="{{ trim($updateJudgeShow[0]->dt_enroll) }}">
                        <label for="dt_ele">Date of Elevation</label>
                        <input id="dt_ele" name="dt_ele" type="date" class=" form-control"
                            value="{{ trim($updateJudgeShow[0]->dt_ele) }}">
                        <label for="dt_appt">Date of Apppointment</label>
                        <input id="dt_appt" name="dt_appt" type="date" class=" form-control"
                            value="{{ trim($updateJudgeShow[0]->dt_appt) }}">
                        <label for="judge_desg">Judge Designation</label>
                        <select id="judge_desg" name="judge_desg" class="select2 form-control custom-select"
                            style="width: 100%; height:36px;">
                            @if ($judge_seniority->count() > 0)
                                <option disabled>Chief Justice - 1</option>
                            @else
                                <option value="1" {{ trim($updateJudgeShow[0]->jd_desg) == '1' ? 'selected' : '' }}>
                                    Chief
                                    Justice - 1</option>
                            @endif
                            <option value="2" {{ trim($updateJudgeShow[0]->jd_desg) == '2' ? 'selected' : '' }}>
                                Acting
                                Chief Justice - 2</option>
                            <option value="3" {{ trim($updateJudgeShow[0]->jd_desg) == '3' ? 'selected' : '' }}>
                                Senior
                                Judge - 3</option>
                            <option value="4" {{ trim($updateJudgeShow[0]->jd_desg) == '4' ? 'selected' : '' }}>
                                Second
                                Senior Judge - 4</option>
                            <option value="5" {{ trim($updateJudgeShow[0]->jd_desg) == '5' ? 'selected' : '' }}>Third
                                Senior Judge - 5</option>
                            <option value="6" {{ trim($updateJudgeShow[0]->jd_desg) == '6' ? 'selected' : '' }}>
                                Fourth
                                Senior Judge - 6</option>
                            <option value="7" {{ trim($updateJudgeShow[0]->jd_desg) == '7' ? 'selected' : '' }}>Fifth
                                Senior Judge - 7</option>
                            <option value="8" {{ trim($updateJudgeShow[0]->jd_desg) == '8' ? 'selected' : '' }}>Sixth
                                Senior Judge - 8</option>
                            <option value="9" {{ trim($updateJudgeShow[0]->jd_desg) == '9' ? 'selected' : '' }}>
                                Seventh Senior Judge - 9</option>
                            <option value="10" {{ trim($updateJudgeShow[0]->jd_desg) == '10' ? 'selected' : '' }}>
                                Eighth Senior Judge - 10</option>
                            <option value="11" {{ trim($updateJudgeShow[0]->jd_desg) == '11' ? 'selected' : '' }}>
                                Ninth
                                Senior Judge - 11</option>
                            <option value="12" {{ trim($updateJudgeShow[0]->jd_desg) == '12' ? 'selected' : '' }}>
                                Tenth
                                Senior Judge - 12</option>
                        </select>
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Contact</h3>
                    <section>
                        <label for="telephone">Telephone Number</label>
                        <input id="telephone" name="telephone" type="text" class=" form-control"
                            value="{{ trim($updateJudgeShow[0]->jd_telephone_no) }}">
                        <label for="fax">Fax Number</label>
                        <input id="fax" name="fax" type="text" class=" form-control"
                            value="{{ trim($updateJudgeShow[0]->jd_fax_no) }}">
                        <label for="mobile">Mobile Number</label>
                        <input id="mobile" name="mobile" type="text" class=" form-control"
                            value="{{ trim($updateJudgeShow[0]->jd_mobile_no) }}">
                        <label for="email">Email ID</label>
                        <input id="email" name="email" type="text" class=" email form-control"
                            value="{{ trim($updateJudgeShow[0]->jd_email_id) }}">
                    </section>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customjs')
    @include('scripts.judge_js')
@endsection
