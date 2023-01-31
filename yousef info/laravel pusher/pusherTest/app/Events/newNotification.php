<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class newNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Dispatchable : use it if you want macke paralell action
     * SerializesModels : use it if you want
     */

    public $user_id;
    public $post_id;
    public $comment;
    public $date;
    public $time;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->user_id = $data['user_id'];
        $this->post_id = $data['post_id'];
        $this->comment = $data['comment'];
    //     $this->date = date("Y M D", strtotime(Carbon::now()));
    //    $this->time = date("H:i:s", strtotime(Carbon::now()));//h:hower ; i:secound;A: each 12 hwoer

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        // return new Channel('new-notification');//channel-name
        return ['new-notification'];//channel-name
    }
}
