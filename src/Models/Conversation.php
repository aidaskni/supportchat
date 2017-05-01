<?php

namespace Aidaskni\Supportchat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conversation
 * @package Aidas\Supportchat\Models
 */
class Conversation extends Model
{
    /** @var string  */
    protected $table = 'conversations';

    /** @var bool  */
    public $timestamps = true;

    /** @var array  */
    protected $fillable = [
        'title',
        'user_one',
        'user_two',
        'status',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }
}
