<?php

namespace Tests\Unit;

use App\Models\Post;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    protected function loginRoute()
    {
        return route('v1.auth.login');
    }

    public function testPaginatingFeeds(){

        $this->post($this->loginRoute(), [
            'email' => 'dip@gmail.com',
            'password' => '123456'
        ]);

    }
}
