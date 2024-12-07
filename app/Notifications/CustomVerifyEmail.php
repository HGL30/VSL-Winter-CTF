<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->from('no-reply@gmail.com', 'VSL Winter CTF 2024')
            ->subject('Xác nhận địa chỉ email của bạn')
            ->line('Cảm ơn bạn đã đăng ký! Vui lòng xác nhận địa chỉ email của bạn bằng cách nhấp vào liên kết dưới đây.')
            ->action('Xác nhận email', $verificationUrl)
            ->line('Nếu bạn không tạo tài khoản, vui lòng bỏ qua email này.')
            ->line('Best regards,')
            ->salutation('VSL Winter CTF 2024');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', 
            Carbon::now()->addMinutes(60), 
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}
