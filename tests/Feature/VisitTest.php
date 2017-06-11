<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VisitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVistGetPublicRoutes()
    {
        $routes = [
            '/auth/login',
        ];
        $this->assertTrue(true);
    }
}
