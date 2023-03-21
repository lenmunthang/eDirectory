@extends('index')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">District(s)</h4>
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
                            <th>Headquarter</th>
                            <th>Active</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $district)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $district->dist_name }}</td>
                                <td>{{ $district->dist_headquarter }}</td>
                                <td>{{ $district->display }}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit_district_modal" id="edit_btn_dist"
                                        onclick="showDistrictDetails({{ $district->dist_code }})">Edit</button>
                                    {{-- <a href="#" class="btn btn-info btn-sm" data-toggle="tooltip"
                                        title='Edit'>Edit</a> --}}
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('delete_district', $district->dist_code) }}">
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_district_modal"
                id="add_btn_dist">Add New District</button>
        </div>
    </div>

    {{-- Add new district modal --}}
    <div class="modal fade" id="add_district_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add District</h5>
                </div>
                <form id="frmDistrict" action="{{ route('store_district') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="districtName" class="col-sm-2 col-form-label">District Name *</label>
                            <div class="col-sm-8">
                                <input type="text" class=" form-control" id="dist_name" name="dist_name"
                                    placeholder="District Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="districtHeadquarter" class="col-sm-2 col-form-label">Headquarter</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="dist_head" name="dist_head"
                                    placeholder="District Headquarter">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="districtActive" class="col-sm-2 col-form-label">Active</label>
                            <div class="col-sm-4">
                                <select class="form-control custom-select" id="active" name="active">
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="districtImage" class="col-sm-2 col-form-label">District Image</label>
                            <div class="col-sm-4">
                                <img src="{{ asset('assets/images/users/1.jpg') }}" alt="District Photo"
                                    class="img-fluid mb-2" style="width: 200px; height: 200px;"
                                    id="preview-image-before-upload">
                                <input type="file" class="form-control-file" id="dist_img" name="dist_img"
                                    accept="image/*">
                                <div id="image-upload-error" class="text-danger"></div>
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
    <div class="modal fade" id="edit_district_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit District</h5>
                </div>
                <form id="frmDistrict_update" action="{{ route('update_district_data') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="edit-modal-body">
                        {{-- modal body comes from ajax call  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" id="btn_dist_update" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    @include('scripts.district_js')
@endsection
