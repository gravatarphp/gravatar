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

Create a `Gravatar` instance and use it for creating URLs.

``` php
use Gravatar\Gravatar;

// Defaults: no default parameter, use HTTPS
$gravatar = new Gravatar([], true);

// Returns https://secure.gravatar.com/avatar/EMAIL_HASH
$gravatar->avatar('user@domain.com');

// Returns https://secure.gravatar.com/avatar/EMAIL_HASH
// The fourth parameter enables validation and will prevent the
// size parameter from being added to the URL generated.
$gravatar->avatar('user@domain.com', ['s' => 9001], true, true);

// Returns https://secure.gravatar.com/EMAIL_HASH
$gravatar->profile('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH.vcf
$gravatar->vcard('user@domain.com');

// Returns https://secure.gravatar.com/EMAIL_HASH.qr
$gravatar->qrCode('user@domain.com');
```


You can override the globally used protocol (HTTP, HTTPS) by setting the last parameter to true/false.

``` php
use Gravatar\Gravatar;

$gravatar = new Gravatar();

// Returns http://www.gravatar.com/avatar/EMAIL_HASH
$gravatar->avatar('user@domain.com', [], false);

// Returns http://www.gravatar.com/EMAIL_HASH
$gravatar->profile('user@domain.com', false);

// Returns http://www.gravatar.com/EMAIL_HASH.vcf
$gravatar->vcard('user@domain.com', false);

// Returns http://www.gravatar.com/EMAIL_HASH.qr
$gravatar->qrCode('user@domain.com', false);
```


Last, but not least, you can pass default options to the builder and use them to generate avatar URLs.

``` php
use Gravatar\Gravatar;

$gravatar = new Gravatar([
    'size' => 500,
]);

// Returns https://secure.gravatar.com/avatar/EMAIL_HASH?size=500&r=g
$gravatar->avatar('user@domain.com', ['r' => 'g']);
```

## Parameters

If you pass any of the following parameters and turn validation on (fourth parameter in the `avatar()` method), their values will be checked against the allowed values defined in the [Gravatar documentation](http://gravatar.com/site/implement/):

* `s`, `size` -- The image size
* `d`, `default` -- The default image to display if there is no matching Gravatar
* `f`, `forcedefault` -- Tell Gravatar to use the default image even if there is a matching Gravatar
* `r`, `rating` -- The audience rating (`G`, `R`, etc.) to restrict the Gravatar to

If the value fails validation, an `InvalidArgumentException` will be thrown.
Any parameters not listed above are not sanitized or validated in anyway.

## Notes

Profile, vCard and QR Code requests will only work with the primary email address. This is a limitation of Gravatar. However the builder won't complain, since it doesn't know if it is your primary address or not. For more tips and details check the [Gravatar documentation](http://gravatar.com/site/implement/).


## Testing

``` bash
$ composer test
```


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/gravatarphp/gravatar/contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
