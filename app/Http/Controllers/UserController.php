<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Judge;
use App\Models\JudicialOfficers;
use App\Models\SubDivision;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        echo "<pre>";
        print_r($request->all());
        exit;
        $this->validate($request, [
            'judge_full_name' => 'required|max:225|string',
            'judge_dob' => 'required|date',
            'judge_qual' => 'required|max:225|string',
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
                // $image = $request->file('image');
                // $new_name = $request->input('judge_full_name') . '.' . $image->getClientOriginalExtension();
                // $image->move(public_path('upload/judge'), $new_name);
                // $img_url = "upload/judge/" . $new_name;
                $image = $request->file('image');
                $new_name = $request->input('judge_full_name') . '.' . $image->getClientOriginalExtension();
                $folder_path = public_path('upload/judge');
                if (!is_dir($folder_path)) {
                    mkdir($folder_path, 0755, true);
                }
                $image->move($folder_path, $new_name);
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
            return redirect()->route('add_judge')->with('fail', 'Error! Judge not added.' . $e->getMessage());
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
            return redirect()->route('judges_list')->with('fail', 'Error! Deletion Unsuccessfully.' . $e->getMessage());
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
        $pop = District::with('sub_divisions')->get();
        $pop_sub_div = SubDivision::all();
        return view('judicial.add_judicial_officer', compact('pop', 'pop_sub_div'));
    }

    public function gradeData(Request $request)
    {

        $max_priority = JudicialOfficers::where('jo_grade', $request->grade_val)->max('jo_priority');
        $data = $max_priority + 1;
        return response()->json($data ?? '');
    }

    public function storeJudicialOfficer(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'jo_status' => 'required',
            'jo_initials' => 'required',
            'jo_fname' => 'required|max:100|string',
            'jo_full_name' => 'required|max:225|string',
            'jo_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'jo_grade' => 'required',
            'jo_desg' => 'required|max:200|string',
            'jo_pop_district' => 'required|array|max:10',
            'jo_dob' => 'required|date',
            'jo_qual' => 'required|max:50|string'
        ]);

        try {
            if (!$request->hasFile('jo_image')) {
                $img_url = null;
            } else {
                $image = $request->file('jo_image');
                $new_name = $request->input('jo_full_name') . '.' . $image->getClientOriginalExtension();
                $folder_path = public_path('upload/judicial officers');
                if (!is_dir($folder_path)) {
                    mkdir($folder_path, 0755, true);
                }
                $image->move($folder_path, $new_name);
                $img_url = "upload/judicial officers/" . $new_name;
            }

            $judicial_officer = new JudicialOfficers();
            $judicial_officer->jo_code = $request->input('jo_code');
            $judicial_officer->jo_title = $request->input('jo_initials');
            $judicial_officer->jo_first_name = $request->input('jo_fname');
            $judicial_officer->jo_middle_name = $request->input('jo_mname');
            $judicial_officer->jo_last_name = $request->input('jo_lname');
            $judicial_officer->jo_name = $request->input('jo_full_name');
            $judicial_officer->jo_photo = $img_url;
            $judicial_officer->jo_grade = $request->input('jo_grade');
            $judicial_officer->jo_priority = $request->input('jo_priority');
            $judicial_officer->jo_designation = $request->input('jo_desg');
            $judicial_officer->jo_mslsa = $request->input('jo_mslsa');
            $judicial_officer->jo_msja = $request->input('jo_msja');
            $judicial_officer->jo_pop_district = json_encode($request->input('jo_pop_district'));
            $judicial_officer->jo_pop_sub_div = json_encode($request->input('jo_pop_sub_div'));
            $judicial_officer->jo_dob = $request->input('jo_dob');
            $judicial_officer->jo_qualification = $request->input('jo_qual');
            $judicial_officer->jo_doa = $request->input('dt_appt');
            $judicial_officer->jo_display = $request->input('jo_status');
            $judicial_officer->jo_telephone_no = $request->input('telephone');
            $judicial_officer->jo_fax_no = $request->input('fax');
            $judicial_officer->jo_mobile_no = $request->input('mobile');
            $judicial_officer->jo_email_id = $request->input('email');
            $judicial_officer->save();
            return redirect()->route('add_jud_officer')->with('success', 'Judicial Officer Added Successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('add_jud_officer')->with('fail', 'Officer Not Added. Error: ' . $e->getMessage());
        }
    }

    public function viewJudicialOfficer()
    {
        // return view('judicial.add_judicial_officer');
    }
}
