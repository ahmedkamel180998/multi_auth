<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AdminEmailVerificationRequest extends EmailVerificationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $admin = $this->user('admin');

        if (! $admin) {
            return false;
        }

        if (! hash_equals(
            (string) $this->route('id'),
            (string) $admin->getKey()
        )) {
            return false;
        }

        if (! hash_equals(
            sha1($admin->getEmailForVerification()),
            (string) $this->route('hash')
        )) {
            return false;
        }

        return true;
    }

    /**
     * Fulfill the email verification request.
     */
    public function fulfill(): void
    {
        $admin = $this->user('admin');

        if (! $admin->hasVerifiedEmail()) {
            $admin->markEmailAsVerified();

            event(new Verified($admin));
        }
    }
}
