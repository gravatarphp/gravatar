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
}
