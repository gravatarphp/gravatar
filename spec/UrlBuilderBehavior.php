<?php

namespace spec\Gravatar;

trait UrlBuilderBehavior
{
    private $email = 'user@domain.com';

    function it_configures_used_protocol()
    {
        $this->useHttps(false);

        $this->profile($this->email)->shouldStartWith('http://');
    }

    function it_returns_an_avatar_url()
    {
        $this->avatar($this->email)->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s', md5($this->email)));
    }

    function it_allows_to_override_protocol_for_avatar_url()
    {
        $this->avatar($this->email, ['secure' => false])->shouldStartWith('http://www.gravatar.com');
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
