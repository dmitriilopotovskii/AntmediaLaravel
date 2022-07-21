<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    /**
     * @param  int  $id
     * @param  string  $name
     * @param  string  $email
     */
    public function __construct(
        public readonly int $id,
        #[Required, StringType]
        public readonly string $name,
        #[Required, StringType]
        public readonly string $email,

    ) {
    }
}
