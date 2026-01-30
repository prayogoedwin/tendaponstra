<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Kreait\Firebase\Factory;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class SosNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $channel;
    private $pesan;
    private $data;

    public function __construct($channel, String $pesan, array $data)
    {
        $this->channel = $channel;
        $this->pesan = $pesan;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return $this->channel;
    }

    /**
     * Notif to firebase
     */
    public function toFcm($notifiable)
    {
        // return (new FcmMessage(notification: new FcmNotification(
        //     title: 'SOS Aku Kejungkel Ning Kaliiiiii',
        //     body: $this->pesan,
        // )))
        //     ->data(
        //         [
        //             'lat' => $this->data['lat'],
        //             'lng' => $this->data['lng'],
        //         ]
        //     );
        return (new FcmMessage())
            ->data([
                'type' => 'SOS',
                'body' => $this->pesan,
                'lat' => $this->data['lat'],
                'lng' => $this->data['lng'],
            ])->custom([
                'android' => [
                    'priority' => 'high',
                ],
                'apns' => [
                    'headers' => [
                        'apns-priority' => '10'
                    ]
                ]
            ]);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
