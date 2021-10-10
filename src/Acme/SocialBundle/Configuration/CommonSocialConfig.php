<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Configuration;

class CommonSocialConfig
{
    /**
     * @param string                        $defaultUsername        Use this value if username not attached to posts
     * @param int                           $maxDailyPosts          Number of max daily posts
     * @param bool                          $allowCommentsOnPosts   Whether comments are allowed on post
     * @param array<string>                 $hashtags               List of hashtags to include in posts
     * @param array<EngagementTargetConfig> $engagementTargets      Expected amounts of likes & shares
     */
    public function __construct(
        public string $defaultUsername,
        public int $maxDailyPosts,
        public bool $allowCommentsOnPosts,
        public array $hashtags,
        public array $engagementTargets,
    ) { }
}