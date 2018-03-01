<?php

namespace Tests;

use Jaspaul\SafeLinkValidator\SafeLinkRule;

class SafeLinkRuleTest extends TestCase
{
    /**
     * @test
     */
    public function passes_returns_false_if_you_provide_an_unsafe_link()
    {
        $rule = new SafeLinkRule();
        $this->assertFalse($rule->passes('attribute', 'http://malware.testing.google.test/testing/malware/'));
    }

    /**
     * @test
     */
    public function passes_returns_true_if_you_provide_a_safe_link()
    {
        $rule = new SafeLinkRule();
        $this->assertTrue($rule->passes('attribute', 'http://www.google.com'));
    }
}
