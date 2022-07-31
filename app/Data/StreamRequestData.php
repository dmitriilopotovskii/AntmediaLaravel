<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class StreamRequestData extends Data
{
    /**
     * @param  string  $name
     * @param  string  $description
     */
    public function __construct(

        #[Required, StringType, Max(20)]
        public string $name,
        #[Required, StringType, Max(50)]
        public string $description,
        #[Required, Url]
        public readonly string $previewURL,

    ) {
    }
}
