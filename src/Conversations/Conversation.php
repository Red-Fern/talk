<?php

namespace Nahid\Talk\Conversations;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table   = 'conversations';
    public $timestamps = true;

    public $fillable   = [
        'user_one',
        'user_two',
        'title',
        'status',
    ];

    /*
     * make a relation between message
     *
     * return collection
     * */
    public function tags()
    {
        return $this->hasMany('Nahid\Talk\Messages\Message', 'conversation_id')
            ->with('sender');
    }

    /*
     * make a relation between message
     *
     * return collection
     * */
    public function messages()
    {
        return $this->hasMany('Nahid\Talk\Messages\Message', 'conversation_id')
            ->with('sender');
    }

    /*
     * make a relation between first user from conversation
     *
     * return collection
     * */
    public function userone()
    {
        return $this->belongsTo(config('talk.user.model', 'App\User'), 'user_one');
    }

    /*
     * make a relation between second user from conversation
     *
     * return collection
     * */
    public function usertwo()
    {
        return $this->belongsTo(config('talk.user.model', 'App\User'), 'user_two');
    }

    /*
     * adds a tag to this conversation
     *
     * return bool
     * */
    public function addTag(\Nahid\Talk\Tags $tag)
    {
        $this->tags()->attach($tag->id);
        return true;
    }
}
