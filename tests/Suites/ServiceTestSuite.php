<?php

namespace Tests\Suites;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Abstract suite for service base test cases
 * @package Tests\Suites
 */
abstract class ServiceTestSuite extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @return void
     */
    protected function setPrerequisites()
    {
        $this->setService();
    }

    abstract public function setService();
}
