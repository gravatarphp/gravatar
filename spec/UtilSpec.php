<?php

namespace spec\Gravatar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UtilSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Gravatar\Util');
    }

    function it_sets_used_endpoint()
    {
        $this->useHttps(false);

        $this->profile('user@domain.com')->shouldStartWith('http://');

        $this->useHttps(true);
    }

    function it_returns_an_avatar_url()
    {
        $email = 'user@domain.com';

        $this->avatar($email)->shouldReturn(sprintf('https://secure.gravatar.com/avatar/%s', md5($email)));
    }

    function it_returns_a_profile_url()
    {
        $email = 'user@domain.com';

        $this->profile($email)->shouldReturn(sprintf('https://secure.gravatar.com/%s', md5($email)));
    }

    function it_returns_a_vcard_url()
    {
        $email = 'user@domain.com';

        $this->vcard($email)->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', md5($email), 'vcf'));
    }

    function it_returns_a_qrcode_url()
    {
        $email = 'user@domain.com';

        $this->qrCode($email)->shouldReturn(sprintf('https://secure.gravatar.com/%s.%s', md5($email), 'qr'));
    }
}
