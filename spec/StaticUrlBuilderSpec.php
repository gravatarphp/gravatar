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

    function letgo()
    {
        $this->useHttps(true);
    }
}
