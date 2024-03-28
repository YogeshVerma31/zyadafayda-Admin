<?php

namespace App\Http\Controllers;

use App\Models\BannerSlider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BannerSliderController extends Controller
{

    public function index(Request $request)
    {
        try {
            $bannerList = BannerSlider::all();
            return view('banner/list', ['bannerList' => $bannerList]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->file('bannerImage')) {
                $imageBanner = $request->file('bannerImage');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['banner_image'] = $pathBanner;
            }
            $response = BannerSlider::create($request->except(['_token', '_method', 'bannerImage']));

            Session::flash('success', 'Banner created successfully');
            return  redirect()->intended('/banner');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/banner');
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $banner = BannerSlider::find($id);
            return view('banner/edit', ['banner' => $banner]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function update(Request $request, $id)
    {
        try {

            if ($request->file('bannerImage')) {
                $imageBanner = $request->file('bannerImage');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['banner_image'] = $pathBanner;
            }
            $response = BannerSlider::where('id', $id)->update($request->except(['_token', '_method', 'bannerImage']));

            Session::flash('success', 'Banner updated successfully');
            return  redirect()->intended('/banner');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/banner');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $banner = BannerSlider::where("id", $id);
            $banner->delete();
            Session::flash('success', 'Banner Slider delete successfully');
            return  redirect()->intended('/banner');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return  redirect()->intended('/banner');
        }
    }

    //api
    public function post_banner(Request $request)
    {
        try {

            $path = '';

            if ($request->file('banner_image')) {
                $image = $request->file('banner_image');
                $path = $image->store('images', 'public');
            } else {
                return response()->json(["status" => 500, "message" => "Banner Image required!", "data" => []], 500);
            }

            if (!$request->banner_link) {
                return response()->json(["status" => 500, "message" => "Banner Link required!", "data" => []], 500);
            }
            BannerSlider::create([
                'banner_image' => $path,
                'banner_link' => $request->banner_link,
            ]);

            return response()->json(["status" => 200, "message" => "Banner Created Successfully!", "data" => []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_banner(Request $request)
    {
        try {

            $banner_list = BannerSlider::get();

            return response()->json(["status" => 200, "message" => "Banner Created Successfully!", "data" => $banner_list], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }
}
