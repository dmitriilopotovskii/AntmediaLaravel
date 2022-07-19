<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('STREAM') }}
        </h2>
    </x-slot>
    <section class="h-screen w-screen bg-gradient-to-br from-pink-50 to-indigo-100 p-8">
        <h1 class="text-center font-bold text-2xl text-indigo-500">User Streams </h1>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="/stream/">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus/>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-label for="description" :value="__('Description')"/>

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" required/>
            </div>
            <!-- previewURL -->
            <div class="mt-4">
                <x-label for="previewURL" :value="__('previewURL')"/>

                <x-input id="previewURL" class="block mt-1 w-full" type="text" name="previewURL" required/>
            </div>


            <div class="flex items-center justify-end mt-4">


                <x-button class="ml-4">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>


    </section>
</x-app-layout>
