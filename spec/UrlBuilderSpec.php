<?php

namespace spec\Gravatar;

use PhpSpec\ObjectBehavior;

class UrlBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Gravatar\UrlBuilder');
    }

    function it_configures_used_protocol()
    {
        $this->useHttps(false);

        $this->profile('user@domain.com')->shouldStartWith('http://');
    }

    function it_returns_an_avatar_url()
    {
        $email = 'user@domain.com';

        $this->avatar($email)->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s', md5($email)));
    }

    function it_throws_an_exception_when_avatar_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringAvatar('invalid');
    }

    function it_returns_a_profile_url()
    {
        $email = 'user@domain.com';

        $this->profile($email)->shouldReturn(sprintf('https://secure.gravatar.com/%s', md5($email)));
    }

    function it_throws_an_exception_when_profile_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringProfile('invalid');
    }

    function it_returns_a_vcard_url()
    {
        $email = 'user@domain.com';

        $this->vcard($email)->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', md5($email), 'vcf'));
    }

    function it_throws_an_exception_when_vcard_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringVcard('invalid');
    }

    function it_returns_a_qrcode_url()
    {
        $email = 'user@domain.com';

        $this->qrCode($email)->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', md5($email), 'qr'));
    }

    function it_throws_an_exception_when_qrcode_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringQrCode('invalid');
    }
}
