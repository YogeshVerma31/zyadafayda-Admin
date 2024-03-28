<?php

namespace App\Http\Controllers;

use App\Models\LearningVideo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LearningVideoController extends Controller
{

    public function index(Request $request)
    {
        try {
            $videoList = LearningVideo::all();
            return view('learningVideo/list', ['videoList' => $videoList]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->file('thumbnailImage')) {
                $imageBanner = $request->file('thumbnailImage');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['thumbnail'] = $pathBanner;
            }
            $response = LearningVideo::create($request->except(['_token', '_method', 'thumbnailImage']));

            Session::flash('success', 'video added successfully');
            return  redirect()->intended('/videos');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/videos');
        }
    }


    public function update(Request $request, $id)
    {
        try {

            if ($request->file('thumbnailImage')) {
                $imageBanner = $request->file('thumbnailImage');
                $pathBanner = $imageBanner->store('images', 'public');
                $request['thumbnail'] = $pathBanner;
            }
            $response = LearningVideo::where('id', $id)->update($request->except(['_token', '_method', 'thumbnailImage']));

            Session::flash('success', 'Video updated successfully');
            return  redirect()->intended('/videos');
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
            Session::flash('error', $e->getMessage());
            return redirect()->intended('/videos');
        }
    }


    public function updateStatus(Request $request, $id)
    {

        try {

            $learningVideo = LearningVideo::where('id', '=', $id)->first();

            if (!$learningVideo) {
                Session::flash('error', 'Video not found');
                return redirect()->intended("/videos");
            }

            LearningVideo::where('id', '=', $id)->update(['status' => !$learningVideo->status]);

            Session::flash('success', 'Video updated successfully');
            return redirect()->intended("/videos");
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->intended("/videos");
            // print_r($e->getMessage());
            // die;
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $banner = LearningVideo::find($id);
            return view('learningVideo/edit', ['video' => $banner]);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return view('index');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $video = LearningVideo::where("id", $id);
            $video->delete();
            Session::flash('success', 'video delete successfully');
            return  redirect()->intended('/videos');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return  redirect()->intended('/videos');
        }
    }




    public function post_video_account(Request $request)
    {
        try {

            $path = '';
            $isYoutube = false;

            if ($request->file('video_thumbnail')) {
                $image = $request->file('video_thumbnail');
                $path = $image->store('images', 'public');
            } else {
                return response()->json(["status" => 500, "message" => "Thumbnail Image required!", "data" => []], 500);
            }

            if (!$request->video_link) {
                return response()->json(["status" => 500, "message" => "Thumbnail Link required!", "data" => []], 500);
            }
            if ($request->isYoutube == null) {
                return response()->json(["status" => 500, "message" => "isYoutube field required!", "data" => []], 500);
            }
            LearningVideo::create([
                'thumbnail' => $path,
                'link' => $request->video_link,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'isYoutube' => $request->isYoutube,
            ]);

            return response()->json(["status" => 200, "message" => "Investment Added Successfully!", "data" => []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_video_list(Request $request)
    {
        try {

            $demat_list = LearningVideo::where("status", true)->get();

            return response()->json(["status" => 200, "message" => "sucess!", "data" => $demat_list], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }
}
