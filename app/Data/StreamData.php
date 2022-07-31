<?php

namespace App\Data;

use App\Models\Stream;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class StreamData extends Data
{

    public function __construct(
        public readonly int|Optional $id,
        #[Required, StringType]
        public readonly string $streamId,
        #[Required, StringType]
        public readonly string $status,
        #[Required, StringType]
        public readonly string $type,
        #[Required, StringType]
        public readonly string $name,
        #[Required, StringType, Max(50)]
        public readonly string $description,
        #[Required, StringType,Url]
        public readonly string $rtmpURL,
        #[Required, Url]
        public readonly string $previewURL,
        public readonly UserData|Optional $user

    ) {
    }

    /**
     * @param  Response  $response
     * @return static
     */
    public static function fromResponseFabric(Response $response, $previewURL): static
    {       //dd($response->collect());
        $collect = $response->collect();

        return new self(
            Optional::create(),
            $collect['streamId'],
            $collect['status'],
            $collect['type'],
            $collect['name'],
            $collect['description'],
            $collect['rtmpURL'],
            $previewURL,
            Optional::create()

        );
    }

    /**
     * @param  Response  $response
     * @param $previewURL
     * @param $user
     * @return static
     */
    public static function fromResponse(Response $response, $previewURL, $user): static
    {
        $collect = $response->collect();

        return new self(
            Optional::create(),
            $collect['streamId'],
            $collect['status'],
            $collect['type'],
            $collect['name'],
            $collect['description'],
            $collect['rtmpURL'],
            $previewURL,
            UserData::from($user)

        );
    }

    /**
     * @param  Stream  $stream
     * @return static
     */
    public static function fromModel(Stream $stream): self
    {
        return new self(
            $stream->id,
            $stream->streamId,
            $stream->status,
            $stream->type,
            $stream->name,
            $stream->description,
            $stream->rtmpURL,
            $stream->previewURL,
            UserData::from((new User())->find($stream->user_id))
        );
    }
}
