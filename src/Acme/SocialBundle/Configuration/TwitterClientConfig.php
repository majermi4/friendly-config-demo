<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Configuration;

class TwitterClientConfig
{
    public function __construct(
        public int $clientId,
        public string $clientSecret
    ) { }
}