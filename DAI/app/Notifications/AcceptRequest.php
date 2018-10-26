<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class AcceptRequest extends Notification
{
    use Queueable;

    protected $sender_id ;
    protected $game_id ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender_id, $game_id)
    {
        $this->sender_id = $sender_id ;
        $this->game_id = $game_id ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $username = DB::select('select username from user__profiles where user_id = ?',[$this->sender_id]);

        return [
            'sender'=>$username,
            'game' =>$this->game_id
        ];
    }

//    /**
//     * Get the mail representation of the notification.
//     *
//     * @param  mixed  $notifiable
//     * @return \Illuminate\Notifications\Messages\MailMessage
//     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    public function toArray($notifiable)
//    {
//        return [
//            //
//        ];
//    }
}
