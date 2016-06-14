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
        $this->configure([], false);

        $this->profile($this->email)->shouldStartWith('http://');
    }

    function it_accepts_default_params()
    {
        $this->configure(['s' => 500]);

        $this->avatar($this->email)->shouldContain('?s=500');
    }

    function letgo()
    {
        $this->configure();
    }
}
