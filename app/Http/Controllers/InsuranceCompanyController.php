<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InsuranceCompanyController extends Controller
{

    public function index(Request $request)
    {
        try {
            $dematList = InsuranceCompany::all();
            return view('insurance/list', ['insuranceList' => $dematList]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->file('insuranceCompanyLogo')) {
                $imageBanner = $request->file('insuranceCompanyLogo');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['logo'] = $pathBanner;
            }
            $response = InsuranceCompany::create($request->except(['_token', '_method', 'insuranceCompanyLogo']));

            Session::flash('success', 'insurance company added successfully');
            return  redirect()->intended('/insurance');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/insurance');
        }
    }

    public function update(Request $request,$id)
    {
        try {
            if ($request->file('insuranceCompanyLogo')) {
                $imageBanner = $request->file('insuranceCompanyLogo');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['logo'] = $pathBanner;
            }
            $response = InsuranceCompany::where('id', $id)->update($request->except(['_token', '_method', 'insuranceCompanyLogo']));

            Session::flash('success', 'Insurance Company updated successfully');
            return  redirect()->intended('/insurance');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/insurance');
        }
    }


    public function edit(Request $request, $id)
    {
        try {
            $banner = InsuranceCompany::find($id);
            return view('insurance/edit', ['insurance' => $banner]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function updateStatus(Request $request, $id)
    {

        try {

            $learningVideo = InsuranceCompany::where('id', '=', $id)->first();

            if (!$learningVideo) {
                Session::flash('error', 'Insurance Company not found');
                return redirect()->intended("/insurance");
            }

            InsuranceCompany::where('id', '=', $id)->update(['status' => !$learningVideo->status]);

            Session::flash('success', 'Insurance company updated successfully');
            return redirect()->intended("/insurance");
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->intended("/insurance");
            // print_r($e->getMessage());
            // die;
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $video = InsuranceCompany::where("id", $id);
            $video->delete();
            Session::flash('success', 'Insurance Company deleted successfully');
            return  redirect()->intended('/insurance');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return  redirect()->intended('/insurance');
        }
    }












    //APIS
    public function post_insurance_account(Request $request)
    {
        try {

            $path = '';

            if ($request->file('insurance_logo')) {
                $image = $request->file('insurance_logo');
                $path = $image->store('images', 'public');
            } else {
                return response()->json(["status" => 500, "message" => "Insurance Image required!", "data" => []], 500);
            }

            if (!$request->insurance_link) {
                return response()->json(["status" => 500, "message" => "Insurance Link required!", "data" => []], 500);
            }
            InsuranceCompany::create([
                'logo' => $path,
                'link' => $request->insurance_link,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]);

            return response()->json(["status" => 200, "message" => "Insurance Added Successfully!", "data" => []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_insurance_list(Request $request)
    {
        try {

            $demat_list = InsuranceCompany::get();

            return response()->json(["status" => 200, "message" => "sucess!", "data" => $demat_list], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }


}
