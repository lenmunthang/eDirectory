@extends('index')
@section('content')
    <div class="card">
        <div class="card-body">
            @include('flash')
            <div class="row justify-content-center mb-3">
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="judge_radio" id="active_judges_rd" checked>
                        <label class="form-check-label" for="active_judges_rd" style="cursor: pointer;">
                            Active Judges
                        </label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="judge_radio" id="inactive_judges_rd">
                        <label class="form-check-label" for="inactive_judges_rd" style="cursor: pointer;">
                            Inactive Judges
                        </label>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="active_judges">
                <table id="table_active" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Judge Priority</th>
                            <th>Judge Name</th>
                            <th>Date of Birth</th>
                            <th>Educational Qualifications</th>
                            <th>Date of Enrollment</th>
                            <th>Date of Elevation</th>
                            <th>Date of Appoitment</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($active_judges as $judge)
                            <tr>
                                <td>{{ $judge->jd_desg }}</td>
                                <td>Hon'ble {{ $judge->jd_title . ' Justice ' . $judge->jd_name }}</td>
                                <td>{{ $judge->jd_dob }}</td>
                                <td>{{ $judge->jd_qual }}</td>
                                <td>{{ $judge->dt_enroll }}</td>
                                <td>{{ $judge->dt_ele }}</td>
                                <td>{{ $judge->dt_appt }}</td>
                                {{-- <td><button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip"
                                        title='Edit'>Edit</button></td> --}}
                                <td><a href="{{ route('update_judge_show', $judge->jd_id) }}"
                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                        title='Edit'>Edit</a></td>
                                <td>
                                    <form method="POST" action="{{ route('judge_delete', $judge->jd_id) }}">
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
            <div class="table-responsive" id="inactive_judges">
                <table id="table_inactive" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Judge Priority</th>
                            <th>Judge Name</th>
                            <th>Date of Birth</th>
                            <th>Educational Qualifications</th>
                            <th>Date of Enrollment</th>
                            <th>Date of Elevation</th>
                            <th>Date of Appoitment</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inactive_judges as $judge)
                            <tr>
                                <td>{{ $judge->jd_desg }}</td>
                                <td>Hon'ble {{ $judge->jd_title . ' Justice ' . $judge->jd_name }}</td>
                                <td>{{ $judge->jd_dob }}</td>
                                <td>{{ $judge->jd_qual }}</td>
                                <td>{{ $judge->dt_enroll }}</td>
                                <td>{{ $judge->dt_ele }}</td>
                                <td>{{ $judge->dt_appt }}</td>
                                {{-- <td><button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip"
                                        title='Edit'>Edit</button></td> --}}
                                <td><a href="{{ route('update_judge_show', $judge->jd_id) }}"
                                        class="btn btn-info btn-sm">Edit</a></td>
                                <td>
                                    <form method="POST" action="{{ route('judge_delete', $judge->jd_id) }}">
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
@endsection

@section('customjs')
    @include('scripts.judge_js')
@endsection
