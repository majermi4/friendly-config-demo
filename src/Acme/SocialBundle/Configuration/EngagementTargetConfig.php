<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Configuration;

use Webmozart\Assert\Assert;

class EngagementTargetConfig
{
    public const TYPE_LIKE = 'like';
    public const TYPE_SHARE = 'share';
    public const TYPES = [self::TYPE_LIKE, self::TYPE_SHARE];

    public function __construct(
        public string $type,
        public int $idealReactionsCount,
        public int $minimalReactionsCount,
    ) {
        Assert::inArray($type, self::TYPES);
        Assert::greaterThan($this->idealReactionsCount, 0);
        Assert::greaterThan($this->minimalReactionsCount, 0);
    }
}