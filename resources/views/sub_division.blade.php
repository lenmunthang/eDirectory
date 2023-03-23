@extends('index')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">District Sub-Division(s)</h4>
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
            
            <div class="table-responsive">
                <table id="table_district" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>District</th>
                            <th>Sub-Division</th>
                            <th>Active</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_divisions as $sub_division)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sub_division->district->dist_name }}</td>
                                <td>{{ $sub_division->sub_div_name }}</td>
                                <td>{{ $sub_division->display }}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit_sub_div_modal" id="edit_btn_sub_div"
                                        onclick="showSubDivisionDetails({{ $sub_division->sub_div_code }})">Edit</button>
                                    {{-- <a href="#" class="btn btn-info btn-sm" data-toggle="tooltip"
                                        title='Edit'>Edit</a> --}}
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('delete_sub_division', $sub_division->sub_div_code) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="border-top">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_sub_div_modal"
                id="add_btn_sub_div">Add New Sub Division</button>
        </div>
    </div>

    {{-- Add new district modal --}}
    <div class="modal fade" id="add_sub_div_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Division</h5>
                </div>
                <form id="frmSubDivision" action="{{ route('store_sub_division') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="dist_code" class="col-sm-2 col-form-label">Select District</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="dist_code" name="dist_code" required>
                                    <option value="">Select District</option>
                                    @foreach ($district_list as $district)
                                    <option value="{{$district->dist_code}}">{{$district->dist_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sub_div_name" class="col-sm-2 col-form-label">Sub Division</label>
                            <div class="col-sm-6">
                                <input type="text" class="required form-control" id="sub_div_name" name="sub_div_name"
                                    placeholder="Sub Division Name here" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sub_div_active" class="col-sm-2 col-form-label">Active</label>
                            <div class="col-sm-4">
                                <select class="form-control custom-select" id="sub_div_active" name="sub_div_active">
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal for editing district  --}}
    <div class="modal fade" id="edit_sub_div_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Division</h5>
                </div>
                <form id="frmSubDivision_update" action="#" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="edit-subdiv-modal-body">
                        {{-- modal body comes from ajax call  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" id="btn_sub_div_update" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    @include('scripts.district_js')
@endsection
