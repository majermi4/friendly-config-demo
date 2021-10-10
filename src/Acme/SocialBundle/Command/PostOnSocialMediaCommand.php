<?php
declare(strict_types=1);

namespace Acme\SocialBundle\Command;

use Acme\SocialBundle\Configuration\CommonSocialConfig;
use Acme\SocialBundle\Configuration\SocialBundleConfig;
use Acme\SocialBundle\Service\FacebookClient;
use Acme\SocialBundle\Service\TwitterClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PostOnSocialMediaCommand extends Command
{
    protected static $defaultName = 'post-on-social-media';
    protected static $defaultDescription = 'Command that simulates posting on social media.';

    private CommonSocialConfig $commonSocialConfig;

    public function __construct(
        private TwitterClient $twitterClient,
        private FacebookClient $facebookClient,
        SocialBundleConfig $socialBundleConfig
    ) {
        parent::__construct();

        $this->commonSocialConfig = $socialBundleConfig->common;
    }

    public function configure() : void
    {
        $this
            ->addArgument('message', InputArgument::REQUIRED)
            ->addOption('username', 'u', InputOption::VALUE_REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $message = $input->getArgument('message');
        $username = $input->getOption('username');
        if (!is_string($username)) {
            $username = $this->commonSocialConfig->defaultUsername;
        }

        $messageWithHashtags = $message . ' ' . implode(
            ' ',
            array_map(
                fn (string $hashtag) => '#' . $hashtag,
                $this->commonSocialConfig->hashtags
            )
        );

        /** @var TwitterClient|FacebookClient $socialMediaClient */
        foreach ([$this->twitterClient, $this->facebookClient] as $socialMediaClient) {
            $response = $socialMediaClient->makePost($messageWithHashtags, $username);

            $output->writeln("<info>$response</info>");
        }

        return 0;
    }
}