<?php

namespace spec\Gravatar;

use PhpSpec\ObjectBehavior;

class StaticUrlBuilderSpec extends ObjectBehavior
{
    use UrlBuilderBehavior;

    function it_is_initializable()
    {
        $this->shouldHaveType('Gravatar\StaticUrlBuilder');
    }

    function it_configures_used_protocol()
    {
        $this->useHttps(false);

        $this->profile($this->email)->shouldStartWith('http://');

        $this->useHttps(true);
    }
}
