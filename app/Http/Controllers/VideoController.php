<?php

namespace App\Http\Controllers;

use App\Series;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'watchable_id' => 'required|numeric|exists:series,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $data = $request->only(['watchable_id', 'title', 'description']);
        $data['watchable_type'] = Series::class;
        $video = Video::query()->create($data);

        return mainResponse(true, __('ok'), $video, [], 200);
    }

    public function find($series_id)
    {
        $series = Series::query()->find($series_id);
//        $series = Series::query()->find($series_id)->videos;
        $series['videos'] = $series->videos;
        return mainResponse(true, __('ok'), $series, [], 200);
    }

    public function findVideo($video_id)
    {
        $video = Video::query()->find($video_id)->watchable;
        return mainResponse(true, __('ok'), $video, [], 200);
    }
}
