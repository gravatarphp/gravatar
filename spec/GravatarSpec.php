<?php

namespace spec\Gravatar;

use Gravatar\Gravatar;
use PhpSpec\ObjectBehavior;

class GravatarSpec extends ObjectBehavior
{
    private $email = 'user@domain.com';

    function it_is_initializable()
    {
        $this->shouldHaveType(Gravatar::class);
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

    function it_returns_an_avatar_url_with_short_name_options()
    {
        $this
            ->avatar($this->email, ['s' => 500, 'd' => '404', 'f' => 'y', 'r' => 'g'])
            ->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s?s=500&d=404&f=y&r=g', md5($this->email)));
    }

    function it_returns_an_avatar_url_with_long_name_options()
    {
        $this
            ->avatar($this->email, ['size' => 500, 'default' => '404', 'forcedefault' => 'y', 'rating' => 'g'])
            ->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s?size=500&default=404&forcedefault=y&rating=g', md5($this->email)));
    }

    function it_returns_an_avatar_url_with_urlencoded_default_image()
    {
        $defaultImageUrl = 'http://www.foo.com/bar.jpg';
        $this
            ->avatar($this->email, ['default' => $defaultImageUrl])
            ->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s?default=%s', md5($this->email), urlencode($defaultImageUrl)));
    }

    function it_allows_to_override_protocol_for_avatar_url()
    {
        $this->avatar($this->email, [], false)->shouldStartWith('http://www.gravatar.com');
    }

    function it_throws_an_exception_for_a_size_option_under_the_minimum()
    {
        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['s' => -1], true, true]);

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['size' => -1000], true, true]);
    }

    function it_throws_an_exception_for_a_size_option_over_the_maxmum()
    {
        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['s' => 9001], true, true]);

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['size' => 9001], true, true]);
    }

    function it_throws_an_exception_for_an_invalid_default_image_option()
    {
        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['d' => 'foobar'], true, true]);

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['default' => 'foobar'], true, true]);
    }

    function it_throws_an_exception_for_an_invalid_force_default_option()
    {
        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['f' => 'foobar'], true, true]);

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['forcedefault' => 'foobar'], true, true]);
    }

    function it_throws_an_exception_for_an_invalid_rating_option()
    {
        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['r' => 'foobar'], true, true]);

        $this
            ->shouldThrow('\InvalidArgumentException')
            ->during('avatar', [$this->email, ['rating' => 'foobar'], true, true]);
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
