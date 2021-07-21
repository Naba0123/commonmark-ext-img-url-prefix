<?php

namespace Naba0123\CommonMarkExt\ImgUrlPrefix\Tests\Integration;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Naba0123\CommonMarkExt\ImgUrlPrefix\ImgUrlPrefixExtension;
use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{
    public function testWithNoOptions()
    {
        $this->_execTest(
            [],
            'start ![title](sample.jpg) end',
            '<p>start <img src="sample.jpg" alt="title" /> end</p>'
        );
        $this->_execTest(
            [],
            'start ![title]($sample.jpg) end',
            '<p>start <img src="$sample.jpg" alt="title" /> end</p>'
        );
    }

    public function testWithOptions()
    {
        $this->_execTest(
            [
                'img_pre_url-pre_url' => '/example/dir/',
                'img_pre_url-distinction_char' => '@',
            ],
            'start ![title](sample.jpg) end',
            '<p>start <img src="sample.jpg" alt="title" /> end</p>'
        );
        $this->_execTest(
            [
                'img_pre_url-pre_url' => '/example/dir/'
            ],
            'start ![title](@sample.jpg) end',
            '<p>start <img src="/example/dir/sample.jpg" alt="title" /> end</p>'
        );
        $this->_execTest(
            [
                'img_pre_url-pre_url' => '/example/dir/',
                'img_pre_url-distinction_char' => '$',
            ],
            'start ![title]($sample.jpg) end',
            '<p>start <img src="/example/dir/sample.jpg" alt="title" /> end</p>'
        );
    }


    protected function _execTest(array $converterOptions, string $sourceStr, string $expectedStr)
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new ImgUrlPrefixExtension());

        $converter = new CommonMarkConverter($converterOptions, $environment);

        $output = $converter->convertToHtml($sourceStr);

        $this->assertEquals($expectedStr . PHP_EOL, $output);
    }

}
