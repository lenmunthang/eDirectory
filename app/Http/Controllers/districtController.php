<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\SubDivision;
use Exception;
use Illuminate\Http\Request;

class districtController extends Controller
{ 
    public function viewDistrict()
    {
        $districts = District::orderBy('dist_code', 'ASC')->get();
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

    public function viewSubDivision()
    {
        $sub_divisions = SubDivision::with('district')->orderBy('sub_div_code', 'ASC')->get();
        $district_list = District::all();
        // echo "<pre>";
        // print_r($sub_divisions->all());
        // exit;
        return view('sub_division', compact('sub_divisions', 'district_list'));
    }

    public function storeSubDivision(Request $request)
    {
        $this->validate($request, [
            'dist_code' => 'required',
            'sub_div_name' => 'required|max:50|string',
        ]);

        try {
            $sub_div = new SubDivision();
            $sub_div->dist_code = $request->input('dist_code');
            $sub_div->sub_div_name = $request->input('sub_div_name');
            $sub_div->display = $request->input('sub_div_active');
            $sub_div->save();
            return redirect()->route('view_sub_division')->with('success', 'Sub Division Added Successfully.');
        } catch (Exception $e) {
            // dd($e->getMessage());
            // exit;
            return redirect()->route('view_sub_division')->with('fail', 'Error! Sub Division Not Added.');
        }
    }

    public function updateSubDivisionShow(Request $request)
    {

        $subdiv_id = $request->subdiv_id;
        $sub_division_data = SubDivision::with('district')->where('sub_div_code', $subdiv_id)->get();
        // echo "<pre>";
        // print_r($sub_division_data[0]->district->dist_name);
        // exit;
        return view('sub_division_details', compact('sub_division_data'));
    }
}
