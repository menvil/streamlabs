<?php

namespace App\Services;

use romanzipp\Twitch\Twitch;

class TwitchService
{
    public static function getFollowedStreams()
    {
        $twitch = new Twitch;
        $twitch->setClientId(config('services.twitch.client_id'));
        $twitch->setClientSecret(config('services.twitch.client_secret'));
        $twitchCredentials = \Auth::user()->connectedAccounts()->where('provider','twitch')->first();
        $twitch->setToken($twitchCredentials->token);
        return $twitch->getFollowedStreams(['user_id' => $twitchCredentials->provider_id]);
    }
}
