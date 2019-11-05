<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
        //不优化的方法
//        $reply->topic->increment('reply_count',1);

        //比较好的方法
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}