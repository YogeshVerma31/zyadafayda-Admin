<?php

namespace App\Http\Controllers;

use App\Models\InvestmentCompany;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvestmentCompanyController extends Controller
{

    public function index(Request $request)
    {
        try {
            $dematList = InvestmentCompany::all();
            return view('investment/list', ['investmentList' => $dematList]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->file('investmentCompanyLogo')) {
                $imageBanner = $request->file('investmentCompanyLogo');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['logo'] = $pathBanner;
            }
            $response = InvestmentCompany::create($request->except(['_token', '_method', 'investmentCompanyLogo']));

            Session::flash('success', 'investment company added successfully');
            return  redirect()->intended('/investment');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/investment');
        }
    }

    public function update(Request $request,$id)
    {
        try {
            if ($request->file('investmentCompanyLogo')) {
                $imageBanner = $request->file('investmentCompanyLogo');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['logo'] = $pathBanner;
            }
            $response = InvestmentCompany::where('id', $id)->update($request->except(['_token', '_method', 'investmentCompanyLogo']));

            Session::flash('success', 'Investment Company updated successfully');
            return  redirect()->intended('/investment');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/investment');
        }
    }


    public function edit(Request $request, $id)
    {
        try {
            $banner = InvestmentCompany::find($id);
            return view('investment/edit', ['investment' => $banner]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function updateStatus(Request $request, $id)
    {

        try {

            $learningVideo = InvestmentCompany::where('id', '=', $id)->first();

            if (!$learningVideo) {
                Session::flash('error', 'Investment Company not found');
                return redirect()->intended("/investment");
            }

            InvestmentCompany::where('id', '=', $id)->update(['status' => !$learningVideo->status]);

            Session::flash('success', 'Investment company updated successfully');
            return redirect()->intended("/investment");
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->intended("/investment");
            // print_r($e->getMessage());
            // die;
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $video = InvestmentCompany::where("id", $id);
            $video->delete();
            Session::flash('success', 'Investment Company deleted successfully');
            return  redirect()->intended('/investment');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return  redirect()->intended('/investment');
        }
    }


    //APIS
    public function post_investment_account(Request $request)
    {
        try {

            $path = '';

            if ($request->file('investment_logo')) {
                $image = $request->file('investment_logo');
                $path = $image->store('images', 'public');
            } else {
                return response()->json(["status" => 500, "message" => "Investment Image required!", "data" => []], 500);
            }

            if (!$request->investment_link) {
                return response()->json(["status" => 500, "message" => "Investment Link required!", "data" => []], 500);
            }
            InvestmentCompany::create([
                'logo' => $path,
                'link' => $request->investment_link,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]);

            return response()->json(["status" => 200, "message" => "Investment Added Successfully!", "data" => []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_investment_list(Request $request)
    {
        try {

            $demat_list = InvestmentCompany::get();

            return response()->json(["status" => 200, "message" => "sucess!", "data" => $demat_list], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }
}
