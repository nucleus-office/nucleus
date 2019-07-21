<?php

namespace NucleusOffice\People\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class VerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $prefix = trim(config('foundation.frontend.url'), '/') . '/' . trim(config('foundation.frontend.email_verify_url'), '/') . '/';

        $temporarySignedURL = URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->uuid], false
        );

        return $prefix . Str::replaceFirst('/api/people/email/verify/', '', $temporarySignedURL);
    }
}
