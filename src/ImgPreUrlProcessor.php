<?php

namespace Naba0123\CommonMark\Ext\ImgUrlPrefix;

use League\CommonMark\EnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Inline\Element\Image;

final class ImgUrlPrefixProcessor
{
    /** @var EnvironmentInterface */
    private $environment;

    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param DocumentParsedEvent $e
     *
     * @return void
     */
    public function __invoke(DocumentParsedEvent $e)
    {
        $preUrl = $this->environment->getConfig('img_pre_url-pre_url', '/');
        $distinctionChar = $this->environment->getConfig('img_pre_url-distinction_char', '@');

        $walker = $e->getDocument()->walker();
        while ($event = $walker->next()) {
            if ($event->isEntering() && $event->getNode() instanceof Image) {
                /** @var Image $image */
                $image = $event->getNode();
                if (strpos($image->getUrl(), $distinctionChar) !== 0) {
                    continue;
                }
                $image->setUrl($preUrl . substr($image->getUrl(), 1));
            }
        }
    }
}
