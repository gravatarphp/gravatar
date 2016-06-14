<?php

namespace spec\Gravatar;

use PhpSpec\ObjectBehavior;

class UrlBuilderSpec extends ObjectBehavior
{
    private $email = 'user@domain.com';

    function it_is_initializable()
    {
        $this->shouldHaveType('Gravatar\UrlBuilder');
    }

    function it_configures_used_protocol()
    {
        $this->beConstructedWith([], false);

        $this->profile($this->email)->shouldStartWith('http://');
    }

    function it_accepts_default_options()
    {
        $this->beConstructedWith(['s' => 500]);

        $this->avatar($this->email)->shouldContain('?s=500');
    }

    function it_returns_an_avatar_url()
    {
        $this->avatar($this->email)->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s', md5($this->email)));
    }

    function it_returns_an_avatar_url_with_options()
    {
        $this
            ->avatar($this->email, ['s' => 500, 'r' => 'g'])
            ->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s?s=500&r=g', md5($this->email)))
        ;
    }

    function it_allows_to_override_protocol_for_avatar_url()
    {
        $this->avatar($this->email, [], false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_throws_an_exception_when_avatar_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringAvatar('invalid');
    }

    function it_returns_a_profile_url()
    {
        $this->profile($this->email)->shouldReturn(sprintf('https://secure.gravatar.com/%s', md5($this->email)));
    }

    function it_allows_to_override_protocol_for_profile_url()
    {
        $this->profile($this->email, false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_throws_an_exception_when_profile_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringProfile('invalid');
    }

    function it_returns_a_vcard_url()
    {
        $this->vcard($this->email)->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', md5($this->email), 'vcf'));
    }

    function it_allows_to_override_protocol_for_vcard_url()
    {
        $this->vcard($this->email, false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_throws_an_exception_when_vcard_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringVcard('invalid');
    }

    function it_returns_a_qrcode_url()
    {
        $this->qrCode($this->email)->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', md5($this->email), 'qr'));
    }

    function it_allows_to_override_protocol_for_qrcode_url()
    {
        $this->qrcode($this->email, false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_throws_an_exception_when_qrcode_email_is_invalid()
    {
        $this->shouldThrow('InvalidArgumentException')->duringQrCode('invalid');
    }
}
