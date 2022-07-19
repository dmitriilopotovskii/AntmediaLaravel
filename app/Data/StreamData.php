<?php

namespace App\Data;

use App\Models\Stream;
use Illuminate\Http\Client\Response;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

/**
 *
 */
class StreamData extends Data
{
    /**
     * @param  string  $streamId
     * @param  string  $status
     * @param  string  $type
     * @param  string  $name
     * @param  string  $description
     * @param  string  $rtmpURL
     */
    public function __construct(
        public int|Optional $id,
        #[Required, StringType]
        public string $streamId,
        #[Required, StringType]
        public string $status,
        #[Required, StringType]
        public string $type,
        #[Required, StringType]
        public string $name,
        #[Required, StringType, Max(50)]
        public string $description,
        #[Required, StringType]
        public string $rtmpURL,
        #[Required, Url]
        public string $previewURL,
        public readonly int|Optional $user_id

    ) {
    }

    /**
     * @param  Response  $response
     * @return static
     */
    public static function fromResponseFabric(Response $response, $previewURL): static
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
            Optional::create()

        );
    }

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
            $user

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
            $stream->user_id
        );
    }
}
