<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Service;

use Acme\SocialBundle\Configuration\SocialBundleConfig;
use Acme\SocialBundle\Configuration\TwitterClientConfig;

class TwitterClient
{
    private TwitterClientConfig $twitterClientConfig;

    public function __construct(SocialBundleConfig $socialBundleConfig)
    {
        $this->twitterClientConfig = $socialBundleConfig->twitter;
    }

    public function makePost(string $message, string $username) : string
    {
        // -->
        // Here would be code that sends data to twitter ...
        // <--

        return sprintf(
            'Using Twitter clientId "%s" and clientSecret "%s" to send message with content "%s" as %s.',
            $this->twitterClientConfig->clientId,
            $this->twitterClientConfig->clientSecret,
            $message,
            $username,
        );
    }
}
