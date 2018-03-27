<?php

namespace Block8\ExternalAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, string $provider)
    {
        $serviceUser = Socialite::driver($provider)->user();

        $email = $serviceUser->email;

        if (empty($email) && !empty($serviceUser->userPrincipalName)) {
            $email = $serviceUser->userPrincipalName;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect(route('login'))->withErrors('It doesn\'t look like you have a user account.');
        }

        $this->guard()->login($user, true);
        return $this->sendLoginResponse($request);
    }
}
