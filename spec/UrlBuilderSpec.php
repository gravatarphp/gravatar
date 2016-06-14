<?php

namespace spec\Gravatar;

use PhpSpec\ObjectBehavior;

class UrlBuilderSpec extends ObjectBehavior
{
    use UrlBuilderBehavior;

    function it_is_initializable()
    {
        $this->shouldHaveType('Gravatar\UrlBuilder');
    }

    function it_configures_used_protocol()
    {
        $this->beConstructedWith([], false);

        $this->profile($this->email)->shouldStartWith('http://');
    }

    function it_accepts_default_params()
    {
        $this->beConstructedWith(['s' => 500]);

        $this->avatar($this->email)->shouldContain('?s=500');
    }
}
