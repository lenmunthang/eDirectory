<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Judge;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function accountSettings(Request $request)
    {
        $user = auth()->user();
        return view('account_settings', compact('user'));
    }

    public function accountSettingsUpdate(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'username' => 'required|min:3|max:50|string',
            'email' => 'email',
            'password' => 'required|confirmed|min:6'
        ]);
        $requestData = $request->except(['_token', 'update_user']);
        $requestData['password'] = Hash::make($request->password);
        $user = User::find(auth()->user()->id);
        $user->update($requestData);
        return redirect()->route('account_settings')->with('success', 'User Updated Successfully.');
    }

    public function judgesList(Request $request)
    {
        // $judges = Judge::all(); //this is Eloquent (using Model)
        // $judges = DB :: table('judge')->select('*')->where('jd_display', 'Y')->orderBy('jd_desg', 'ASC')->get(); //this is query builder
        $active_judges = DB::select("SELECT * FROM judge WHERE jd_display = 'Y' ORDER BY jd_desg ASC"); //this is raw query
        $inactive_judges = DB::select("SELECT * FROM judge WHERE jd_display = 'N' ORDER BY jd_desg ASC");
        // echo "<pre>";
        // print_r($judges);
        // exit;
        return view('judges.judges_list', compact('active_judges',  'inactive_judges'));
    }

    public function addJudge(Request $request)
    {
        // $judge_seniority = DB::select("SELECT * FROM judge WHERE jd_display = 'Y' AND jd_desg = '1'");
        $judge_seniority = Judge::where([
            ['jd_display', '=', 'Y'],
            ['jd_desg', '=', '1']
        ]);
        return view('judges.add_judge', compact('judge_seniority'));
    }

    public function storeJudge(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'judge_full_name' => 'required|min:3|max:225|string',
            'judge_dob' => 'required|date',
            'judge_qual' => 'required|min:2|max:225|string',
            'dt_enroll' => 'required|date',
            'judge_desg' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
        ]);

        if ($request->input('judge_status') == "active") {
            $display = "Y";
        } else {
            $display = "N";
        }

        try {
            if (!$request->hasFile('image')) {
                $img_url = null;
            } else {
                $image = $request->file('image');
                $new_name = $request->input('judge_full_name') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/judge'), $new_name);
                $img_url = "upload/judge/" . $new_name;
            }

            $judge = new Judge;
            $judge->jd_title = $request->input('judge_initials');
            $judge->jd_first_name = $request->input('judge_f_name');
            $judge->jd_middle_name = $request->input('judge_m_name');
            $judge->jd_last_name = $request->input('judge_l_name');
            $judge->jd_name = $request->input('judge_full_name');
            $judge->jd_photo = $img_url;
            $judge->jd_dob = $request->input('judge_dob');
            $judge->jd_qual = $request->input('judge_qual');
            $judge->dt_enroll = $request->input('dt_enroll');
            $judge->dt_ele = $request->input('dt_ele');
            $judge->dt_appt = $request->input('dt_appt');
            $judge->jd_desg = $request->input('judge_desg');
            $judge->jd_telephone_no = $request->input('telephone');
            $judge->jd_fax_no = $request->input('fax');
            $judge->jd_mobile_no = $request->input('mobile');
            $judge->jd_email_id = $request->input('email');
            $judge->jd_display = $display;
            $judge->save();
            return redirect()->route('add_judge')->with('success', 'Judge Added Successfully.');
        } catch (Exception $e) {
            // dd($e->getMessage());
            // exit;
            return redirect()->route('add_judge')->with('fail', 'Error! Judge not added.');
        }
    }

    public function delete($id)
    {
        try {
            $judge = Judge::find($id);
            $judge->delete();
            if ($judge->jd_photo != null) {
                unlink(public_path($judge->jd_photo));
            }
            return redirect()->route('judges_list')->with('success', 'Deleted Successfully.');
        } catch (Exception $e) {
            return redirect()->route('judges_list')->with('fail', 'Error! Deletion Unsuccessfully.');
        }
    }

    public function updateJudgeShow($id)
    {
        $updateJudgeShow = Judge::where('jd_id', $id)->get();
        $judge_seniority = Judge::where([
            ['jd_display', '=', 'Y'],
            ['jd_desg', '=', '1']
        ]);
        // $updateJudgeShow = DB::select('select * from judge where jd_id = ?',[$id]);
        // dd($updateJudgeShow[0]->jd_photo);exit;
        // echo "<pre>";
        // print_r($updateJudgeShow->all());
        // exit;
        return view('judges.update_judge', compact('updateJudgeShow', 'judge_seniority'));
    }


    public function addJudicialOfficer()
    {
        return view('judicial.add_judicial_officer');
    }

    public function storeJudicialOfficer()
    {
        // return view('judicial.add_judicial_officer');
    }

    public function viewJudicialOfficer()
    {
        // return view('judicial.add_judicial_officer');
    }

    public function viewDistrict()
    {
        $districts = District::orderBy('dist_code', 'ASC')->get();
        // dd($districts); exit;
        return view('district', compact('districts'));
    }

    public function storeDistrict(Request $request)
    {
        $this->validate($request, [
            'dist_name' => 'required|max:50|string',
            'dist_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
        ]);

        try {
            if (!$request->hasFile('dist_img')) {
                $img_url = null;
            } else {
                $image = $request->file('dist_img');
                $new_name = $request->input('dist_name') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/district'), $new_name);
                $img_url = "upload/district/" . $new_name;
            }

            $judge = new District();
            $judge->dist_name = $request->input('dist_name');
            $judge->dist_headquarter = $request->input('dist_head');
            $judge->dist_img = $img_url;
            $judge->display = $request->input('active');
            $judge->save();
            return redirect()->route('view_district')->with('success', 'District Added Successfully.');
        } catch (Exception $e) {
            // dd($e->getMessage());
            // exit;
            return redirect()->route('view_district')->with('fail', 'Error! District Not Added.');
        }
    }

    public function deleteDistrict($id)
    {
        try {
            $district = District::find($id);
            $district->delete();
            if ($district->dist_img != null) {
                unlink(public_path($district->dist_img));
            }
            return redirect()->route('view_district')->with('success', 'Deleted Successfully.');
        } catch (Exception $e) {
            return redirect()->route('view_district')->with('fail', 'Error! Deletion Unsuccessfully.');
        }
    }

    public function updateDistrictShow(Request $request)
    {

        $dist_id = $request->dist_id;
        $updateDistrictShow = District::where('dist_code', $dist_id)->get();
        // echo "<pre>";
        // print_r($updateDistrictShow[0]->dist_name);
        // exit;
        return view('district_details', compact('updateDistrictShow'));
    }

    public function updateDistrictData(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;

        $this->validate($request, [
            'dist_name_edit' => 'required|max:50|string',
            'dist_img_edit' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
        ]);
        try {
            if (!$request->hasFile('dist_img_edit')) {
                $img_url = $request->dist_img_edit_val;
            } else {
                $image = $request->file('dist_img_edit');
                $new_name = $request->input('dist_name_edit') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/district'), $new_name);
                $img_url = "upload/district/" . $new_name;
            }
            $district_edit = District::find($request->dist_code_edit);
            $district_edit->dist_name = $request->dist_name_edit;
            $district_edit->dist_headquarter = $request->dist_head_edit;
            $district_edit->dist_img = $img_url;
            $district_edit->display = $request->active_edit;
            $district_edit->save();
            return redirect()->route('view_district')->with('success', 'Updated Successfully.');
        } catch (Exception $e) {
            return redirect()->route('view_district')->with('fail', 'Error! Updation Unsuccessfully.');
        }
        
    }
}
