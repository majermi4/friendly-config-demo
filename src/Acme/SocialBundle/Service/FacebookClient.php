<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Service;

use Acme\SocialBundle\Configuration\FacebookClientConfig;
use Acme\SocialBundle\Configuration\SocialBundleConfig;
use Acme\SocialBundle\Configuration\TwitterClientConfig;

class FacebookClient
{
    private FacebookClientConfig $facebookClientConfig;

    public function __construct(SocialBundleConfig $socialBundleConfig)
    {
        $this->facebookClientConfig = $socialBundleConfig->facebook;
    }

    public function makePost(string $message, string $username) : string
    {
        // -->
        // Here would be code that sends data to facebook ...
        // <--

        return sprintf(
            'Using FB clientId "%s" and clientSecret "%s" to send message with content "%s" as %s.',
            $this->facebookClientConfig->clientId,
            $this->facebookClientConfig->clientSecret,
            $message,
            $username,
        );
    }
}
