<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{ $streams->links() }}
    <section class="h-screen w-screen bg-gradient-to-br from-pink-50 to-indigo-100 p-8">
        <h1 class="text-center font-bold text-2xl text-indigo-500">User Streams </h1>

        <div class="grid justify-center md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7 my-10">

            @foreach ($streams as $stream)
                <!-- Card  -->
                <div class="bg-white rounded-lg border shadow-md max-w-xs md:max-w-none overflow-hidden">
                    <video class="w-full aspect-video " controls
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
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="/stream/{{$stream->id}}">open

                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
