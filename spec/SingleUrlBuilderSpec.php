<?php

namespace spec\Gravatar;

use PhpSpec\ObjectBehavior;

class SingleUrlBuilderSpec extends ObjectBehavior
{
    protected $hash;

    public function let()
    {
        $email = 'user@domain.com';
        $this->hash = md5($email);

        $this->beConstructedWith($email);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Gravatar\SingleUrlBuilder');
    }

    function it_throws_an_exception_when_email_is_invalid()
    {
        $this->beConstructedWith('invalid');

        $this->shouldThrow('InvalidArgumentException')->duringInstantiation();
    }

    function it_configures_used_protocol()
    {
        $this->beConstructedWith('user@domain.com', false);

        $this->profile()->shouldStartWith('http://');
    }

    function it_returns_an_avatar_url()
    {
        $this->avatar()->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s', $this->hash));
    }

    function it_allows_to_override_protocol_for_avatar_url()
    {
        $this->avatar([], false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_returns_a_profile_url()
    {
        $this->profile()->shouldReturn(sprintf('https://secure.gravatar.com/%s', $this->hash));
    }

    function it_allows_to_override_protocol_for_profile_url()
    {
        $this->profile(false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_returns_a_vcard_url()
    {
        $this->vcard()->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', $this->hash, 'vcf'));
    }

    function it_allows_to_override_protocol_for_vcard_url()
    {
        $this->vcard(false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_returns_a_qrcode_url()
    {
        $this->qrCode()->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', $this->hash, 'qr'));
    }

    function it_allows_to_override_protocol_for_qrcode_url()
    {
        $this->qrcode(false)->shouldStartWith('http://www.gravatar.com');
    }
}
