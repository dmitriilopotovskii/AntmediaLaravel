<?php

namespace App\Models;

use App\Data\UserData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Http;

/**
 * App\Models\Stream
 *
 * @property int $id
 * @property string $streamId
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $rtmpURL
 * @property string $status
 * @property string|null $previewURL
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\StreamFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stream newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stream query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream wherePreviewURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereRtmpURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereUserId($value)
 * @mixin \Eloquent
 */
class Stream extends Model
{
    use HasFactory;

    /* protected $casts = [
         'user_id' => UserData::class,
     ];*/
    protected $fillable = [
        'streamId',
        'status',
        'type',
        'name',
        'description',
        'rtmpURL',
        'previewURL',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
    {
        return $this->status = Http::get(env('DOCKER_HOST').env('ANT_REST_URL').'v2/broadcasts/'.$this->streamId)->json('status');
    }
}
