<?php
namespace App;

use App\User;
use Socialite;
use App\SocialLoginProfile;
use App\Exceptions\SocialAuthException;

class LoginUser
{
    public function authenticate($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function login($provider)
    {
        try {
            $socialUserInfo = Socialite::driver($provider)->user();
            
            $user = User::firstOrCreate(['email' => $socialUserInfo->getEmail()]);

            if (is_null($user->socialProfile)) {
                $socialProfile = new SocialLoginProfile;
                $user->socialProfile()->save($socialProfile);
            }

            $providerField = "{$provider}_id";
            $user->socialProfile->$providerField = $socialUserInfo->getId();
            $user->socialProfile->save();

            auth()->login($user);
            
        } catch (\Exception $e) {
            throw new SocialAuthException("failed to authenticate with $provider");
        }
    }
}