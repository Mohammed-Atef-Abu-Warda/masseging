<?php

namespace Modules\Messaging\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Messaging\Database\Factories\MessageFactory;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['sender_name', 'body'];
    // protected static function newFactory(): MessageFactory
    // {
    //     // return MessageFactory::new();
    // }
}
