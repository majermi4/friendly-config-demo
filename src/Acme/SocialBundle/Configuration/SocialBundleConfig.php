<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Configuration;

class SocialBundleConfig
{
    /**
     * @param TwitterClientConfig   $twitter    Configures twitter client
     * @param FacebookClientConfig  $facebook   Configures facebook client
     * @param CommonSocialConfig    $common     Configures common social bundle configuration
     */
    public function __construct(
        public TwitterClientConfig $twitter,
        public FacebookClientConfig $facebook,
        public CommonSocialConfig $common
    ) { }
}


