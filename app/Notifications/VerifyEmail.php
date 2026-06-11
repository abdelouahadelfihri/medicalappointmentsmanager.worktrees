<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = url('/email/verify/' . $notifiable->getKey() . '/' . hash('sha256', $notifiable->getEmailForVerification()));

        return (new MailMessage)
            ->subject('Verify Email Address - Medical Appointments Manager')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Thank you for registering with Medical Appointments Manager!')
            ->line('Please verify your email address by clicking the button below:')
            ->action('Verify Email', $verificationUrl)
            ->line('This verification link will expire in 60 minutes.')
            ->line('If you did not create this account, no further action is required.')
            ->salutation('Best regards, Medical Appointments Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Please verify your email address',
        ];
    }
}
