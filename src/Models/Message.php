<?php

namespace Aidaskni\Supportchat\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Models
 */
class Message extends Model
{
    /** @var string */
    protected $table = 'messages';

    /** @var bool */
    //spublic $timestamps = true;

    /** @var array */
    protected $fillable = [
        'conversation_id',
        'user_id',
        'message_body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
