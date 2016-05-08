# Gravatar

[![Latest Version](https://img.shields.io/github/release/gravatarphp/gravatar.svg?style=flat-square)](https://github.com/gravatarphp/gravatar/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/gravatarphp/gravatar.svg?style=flat-square)](https://travis-ci.org/gravatarphp/gravatar)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/gravatarphp/gravatar.svg?style=flat-square)](https://scrutinizer-ci.com/g/gravatarphp/gravatar)
[![Quality Score](https://img.shields.io/scrutinizer/g/gravatarphp/gravatar.svg?style=flat-square)](https://scrutinizer-ci.com/g/gravatarphp/gravatar)
[![Total Downloads](https://img.shields.io/packagist/dt/gravatarphp/gravatar.svg?style=flat-square)](https://packagist.org/packages/gravatarphp/gravatar)

**Gravatar URL builder which is most commonly called as a Gravatar library.**


## Install

Via Composer

``` bash
$ composer require gravatarphp/gravatar
```


## Usage

Create a `UrlBuilder` instance and use it for creating URLs:

``` php
use Gravatar\UrlBuilder;

// Use HTTPS, true by default
$urlBuilder = new UrlBuilder(false);

$urlBuilder->useHttps(true);

// Returns https://secure.gravatar.com/avatar/EMAIL_HASH
$urlBuilder->avatar('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH
$urlBuilder->profile('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH.vcf
$urlBuilder->vcard('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH.qr
$urlBuilder->qrCode('user@domain.com');
```

Or use the static version:

``` php
use Gravatar\StaticUrlBuilder as Gravatar;

// True by default
Gravatar::useHttps(true);

// Returns https://secure.gravatar.com/avatar/EMAIL_HASH
Gravatar::avatar('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH
Gravatar::profile('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH.vcf
Gravatar::vcard('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH.qr
Gravatar::qrCode('user@domain.com');
```

You can also use the `SingleUrlBuilder` which accepts an email in its constructor:

``` php
use Gravatar\SingleUrlBuilder;

// Email
// Use HTTPS, true by default
$urlBuilder = new UrlBuilder('user@domain.com', false);

$urlBuilder->useHttps(true);

// Returns https://secure.gravatar.com/avatar/EMAIL_HASH
$urlBuilder->avatar();

// Returns https://secure.gravatar.com/EMAIL_HASH
$urlBuilder->profile();

// Returns https://secure.gravatar.com/EMAIL_HASH.vcf
$urlBuilder->vcard();

// Returns https://secure.gravatar.com/EMAIL_HASH.qr
$urlBuilder->qrCode();
```

**Note:** Profile, vCard and QR Code requests will only work with the primary email address. This is a limitation of Gravatar. However the builder won't complain, since it doesn't know if it is your primary address or not. For more tips and details check the [Gravatar documentation](http://gravatar.com/site/implement/).


## Testing

``` bash
$ composer test
```


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/gravatarphp/gravatar/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
