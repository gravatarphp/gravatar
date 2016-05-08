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
        $this->useHttps(false);

        $this->profile()->shouldStartWith('http://');
    }

    function it_returns_an_avatar_url()
    {
        $this->avatar()->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s', $this->hash));
    }

    function it_returns_a_profile_url()
    {
        $this->profile()->shouldReturn(sprintf('https://secure.gravatar.com/%s', $this->hash));
    }

    function it_returns_a_vcard_url()
    {
        $this->vcard()->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', $this->hash, 'vcf'));
    }

    function it_returns_a_qrcode_url()
    {
        $this->qrCode()->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', $this->hash, 'qr'));
    }
}
