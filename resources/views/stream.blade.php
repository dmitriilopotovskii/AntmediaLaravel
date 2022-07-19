<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('STREAM') }}
        </h2>
    </x-slot>
<p>{{$stream->rtmpURL}}</p>
    <section class="h-screen w-screen bg-gradient-to-br from-pink-50 to-indigo-100 p-8">
        <h1 class="text-center font-bold text-2xl text-indigo-500">User Streams </h1>
        <div class="grid justify-center md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7 my-10">
            @if ( $stream->status === 'broadcasting' )
                <div class="bg-white rounded-lg border shadow-md max-w-xs md:max-w-none overflow-hidden">
                    <iframe class="w-full aspect-video " controls autoplay
                           src="https://localhost:5443/LiveApp/play.html?name={{$stream->streamId}}"></iframe>
                    <div class="p-3">
                        <span class="text-sm text-primary">user: {{$stream->user->email}}</span>
                        <h3 class="font-semibold text-xl leading-6 text-gray-700 my-2">
                            {{ $stream->name}}
                        </h3>
                        <p class="paragraph-normal text-gray-600">
                            {{$stream->description}}
                        </p>

                        <div class="flex space-x-2 justify-end">

                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg border shadow-md max-w-xs md:max-w-none overflow-hidden">
                    <video class="w-full aspect-video " controls autoplay
                           src="{{$stream->previewURL}}"></video>
                    <div class="p-3">
                        <span class="text-sm text-primary">user: {{$stream->user->email}}</span>
                        <h3 class="font-semibold text-xl leading-6 text-gray-700 my-2">
                            {{ $stream->name}}
                        </h3>
                        <p class="paragraph-normal text-gray-600">
                            {{$stream->description}}
                        </p>

                        <div class="flex space-x-2 justify-end">

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
