<?php

namespace Tests;

use Jaspaul\SafeLinkValidator\Link;

class LinkTest extends TestCase
{
    /**
     * @test
     */
    public function isSafe_returns_false_if_you_provide_an_unsafe_link()
    {
        $link = Link::fromString('http://malware.testing.google.test/testing/malware/');
        $this->assertFalse($link->isSafe());
    }

    /**
     * @test
     */
    public function isSafe_returns_true_if_you_provide_a_safe_link()
    {
        $link = Link::fromString('http://www.google.com/');
        $this->assertTrue($link->isSafe());
    }
}
