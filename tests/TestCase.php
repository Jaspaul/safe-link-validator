<?php

namespace Tests;

use Mockery;
use Orchestra\Testbench\TestCase as Base;

abstract class TestCase extends Base
{
    /**
     * @before
     */
    protected function setUpMockery()
    {
        Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
        Mockery::getConfiguration()->allowMockingMethodsUnnecessarily(false);
    }
}
