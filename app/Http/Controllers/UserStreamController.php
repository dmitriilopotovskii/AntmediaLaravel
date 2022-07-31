<?php

namespace App\Http\Controllers;

use App\Data\StreamData;
use App\Data\StreamRequestData;
use App\Models\Stream;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserStreamController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $streams = Stream::query()
            ->select([
                'id', 'status', 'type', 'streamId', 'name', 'previewURL', 'user_id', 'rtmpURL',
                'description',
            ])->
            with('user:id,email,name')->paginate(6);
        $streamData = StreamData::collection($streams);

        return view('dashboard', ['streams' => $streamData->items()]);
    }

    /**
     * @param  Stream  $stream
     * @return Application|Factory|View
     */
    public function show(Stream $stream): View|Factory|Application
    {
        $stream->getStatus();
        $streamData = StreamData::from($stream);

        return view('stream', ['stream' => $streamData]);
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
            $StreamRequest->except('previewURL')->all());

        $streamData = StreamData::fromResponse($response, $request->previewURL, $request->user());

        $model = Stream::updateOrCreate(
            [
                ...$streamData->except('user')->all(),
                'user_id' => $streamData->user->id,
            ]);

        return redirect()->route('show', ['stream' => $model->id]);
    }
}
