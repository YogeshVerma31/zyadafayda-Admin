<?php

namespace App\Http\Controllers;

use App\Models\DematAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DematAccountController extends Controller
{
    public function index(Request $request)
    {
        try {
            $dematList = DematAccount::all();
            return view('demat/list', ['dematList' => $dematList]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->file('dematCompanyLogo')) {
                $imageBanner = $request->file('dematCompanyLogo');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['logo'] = $pathBanner;
            }
            $response = DematAccount::create($request->except(['_token', '_method', 'dematCompanyLogo']));

            Session::flash('success', 'demat added successfully');
            return  redirect()->intended('/demat');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/demat');
        }
    }

    public function update(Request $request,$id)
    {
        try {
            if ($request->file('dematCompanyLogo')) {
                $imageBanner = $request->file('dematCompanyLogo');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['logo'] = $pathBanner;
            }
            $response = DematAccount::where('id', $id)->update($request->except(['_token', '_method', 'dematCompanyLogo']));

            Session::flash('success', 'demat updated successfully');
            return  redirect()->intended('/demat');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/demat');
        }
    }


    public function edit(Request $request, $id)
    {
        try {
            $banner = DematAccount::find($id);
            return view('demat/edit', ['demat' => $banner]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function updateStatus(Request $request, $id)
    {

        try {

            $learningVideo = DematAccount::where('id', '=', $id)->first();

            if (!$learningVideo) {
                Session::flash('error', 'Demat Company not found');
                return redirect()->intended("/demat");
            }

            DematAccount::where('id', '=', $id)->update(['status' => !$learningVideo->status]);

            Session::flash('success', 'Demat company updated successfully');
            return redirect()->intended("/demat");
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->intended("/demat");
            // print_r($e->getMessage());
            // die;
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $video = DematAccount::where("id", $id);
            $video->delete();
            Session::flash('success', 'Demat Company deleted successfully');
            return  redirect()->intended('/demat');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return  redirect()->intended('/demat');
        }
    }

    public function post_demat_account(Request $request)
    {
        try {

            $path = '';

            if ($request->file('demat_logo')) {
                $image = $request->file('demat_logo');
                $path = $image->store('images', 'public');
            } else {
                return response()->json(["status" => 500, "message" => "Demat Image required!", "data" => []], 500);
            }

            if (!$request->demat_link) {
                return response()->json(["status" => 500, "message" => "Demat Link required!", "data" => []], 500);
            }
            DematAccount::create([
                'logo' => $path,
                'link' => $request->demat_link,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]);

            return response()->json(["status" => 200, "message" => "Demat Added Successfully!", "data" => []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_demat_list(Request $request)
    {
        try {

            $demat_list = DematAccount::get();

            return response()->json(["status" => 200, "message" => "sucess!", "data" => $demat_list], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }
}
