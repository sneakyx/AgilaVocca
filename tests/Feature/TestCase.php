<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Vite deaktivieren, um Tests ohne Frontend-Builds durchzuführen
        config(['vite.enabled' => false]);
    }
}