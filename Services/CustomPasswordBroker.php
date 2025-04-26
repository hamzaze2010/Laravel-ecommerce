<?php

namespace App\Services;

use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerContract;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class CustomPasswordBroker extends PasswordBroker implements PasswordBrokerContract
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $response = app(CustomPasswordBroker::class)->sendResetLink(
            $request->only('email')
        );
    
        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', __($response))
                    : back()->withErrors(['email' => __($response)]);
    }

    protected function emailResetLink(CanResetPasswordContract $user, $token)
    {
        Mail::send('emails.password_reset', ['token' => $token], function ($message) use ($user) {
            $message->to($user->getEmailForPasswordReset());
            $message->subject('Your Password Reset Link');
        });
    }

    public function reset(array $credentials, \Closure $callback)
    {
        $user = $this->validateReset($credentials);

        if (!$user) {
            return static::INVALID_TOKEN;
        }

        $user->password = Hash::make($credentials['password']);
        $user->reset_token = null;
        $user->token_created_at = null;
        $user->save();

        return $callback($user);
    }

    protected function validateReset(array $credentials)
    {
        $user = $this->getUser($credentials);

        if (!$user) {
            return null;
        }

        $isValid = $user->reset_token === $credentials['token'];

        return $isValid ? $user : null;
    }
}
