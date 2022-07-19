<?php

namespace App\Http\Controllers;

use App\Data\StreamData;
use App\Data\StreamRequestData;
use App\Models\Stream;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserStreamController extends Controller
{
    public function index()
    {
        $streams = Stream::query()
            ->select([
                'id', 'status', 'type', 'streamId', 'name', 'previewURL', 'user_id', 'rtmpURL',
                'description',
            ])->
            with('user:id,email,name')->paginate(6);

        return view('dashboard', ['streams' => $streams]);
    }

    /**
     * @param  Stream  $stream
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $stream = Stream::findOrFail($id);
        $stream->getStatus();

        return view('stream', ['stream' => $stream]);
    }

    public function create()
    {
        return view('create');
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $StreamRequest = StreamRequestData::from($request);
        $response = Http::post(env('DOCKER_HOST').env('ANT_REST_URL').'v2/broadcasts/create',
            $StreamRequest->all());
        $streamData = StreamData::fromResponse($response, $request->previewURL, Auth::user()->id);
        $model = Stream::firstOrCreate($streamData->all());
        return redirect()->route('show',['id' => $model->id]);
    }
}
