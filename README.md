# Img url prefix extension

Extension for league/commonmark to add prefix url to img with specitific distinction.

https://packagist.org/packages/naba0123/commonmark-ext-img-url-prefix

## Install

```
composer require naba0123/commonmark-ext-img-url-prefix
```

Example

```
$environment = \League\CommonMark\Environment::createCommonMarkEnvironment();
$environment->addExtension(new \Naba0123\CommonMark\Ext\ImgPreUrl\ImgPreUrlExtension());

$converter = new \League\CommonMark\CommonMarkConverter([
	'img_pre_url-pre_url' => '/example/dir/',
	'img_pre_url-distinction_char' => '@',
], $environment);

echo $converter->convertToHtml('![Alt Text](path.jpg)');
```

The above is converted to Img tag as the following
```
<img src="/example/dir/path.jpg" alt="Alt Text">
```
