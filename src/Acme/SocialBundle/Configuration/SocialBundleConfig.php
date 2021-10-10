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
    private function __construct(
        public TwitterClientConfig $twitter,
        public FacebookClientConfig $facebook,
        public CommonSocialConfig $common
    ) { }

    public static function fromRawConfig(array $config) : self
    {
        return new self(
            new TwitterClientConfig(
                $config['twitter']['client_id'],
                $config['twitter']['client_secret']
            ),
            new FacebookClientConfig(
                $config['facebook']['client_id'],
                $config['facebook']['client_secret']
            ),
            new CommonSocialConfig(
                $config['common']['default_username'],
                $config['common']['max_daily_posts'],
                $config['common']['allow_comments_in_posts'],
                $config['common']['hashtags'],
                array_map(
                    fn (array $engagementTarget) => new EngagementTargetConfig(
                        $engagementTarget['type'],
                        $engagementTarget['ideal_reactions_count'],
                        $engagementTarget['minimal_reactions_count'],
                    ),
                    $config['common']['engagement_targets'],
                ),
            ),
        );
    }
}


