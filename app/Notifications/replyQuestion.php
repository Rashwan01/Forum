<?php

namespace App\Notifications;
use app\Model\reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class replyQuestion extends Notification
{
    protected $reply;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','Broadcast'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
          "replyBy"=>$this->reply->user->name,
          "question"=>$this->reply->question->title,
          "path"=>$this->reply->question->path,
        ];
    }
    public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        "replyBy"=>$this->reply->user->name,
          "question"=>$this->reply->question->title,
          "path"=>$this->reply->question->path,
          "reply"=>$this->reply
    ]);
}
}
