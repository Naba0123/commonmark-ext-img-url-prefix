<?php

namespace Naba0123\CommonMarkExt\ImgUrlPrefix;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;

final class ImgUrlPrefixExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addEventListener(DocumentParsedEvent::class, new ImgUrlPrefixProcessor($environment), -50);
    }
}
