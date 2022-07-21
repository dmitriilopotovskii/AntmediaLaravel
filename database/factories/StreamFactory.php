<?php

namespace Database\Factories;

use App\Data\StreamData;
use App\Data\StreamRequestData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stream>
 */
class StreamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $StreamRequest = new StreamRequestData(
            ''.$this->faker->word,
            ''.$this->faker->text(50)
        );

        $response = Http::post(env('DOCKER_HOST').env('ANT_REST_URL').'v2/broadcasts/create',
            $StreamRequest->all());
        $previewURL = 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4';

        $StreamData = StreamData::fromResponseFabric($response, $previewURL);

        return $StreamData->all();
    }
}
