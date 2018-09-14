<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class UserTest extends TestCase
{
  public function setUp()
  {
      parent::setUp();
      Session::start();
      DB::beginTransaction();
      $this->user = factory(User::class)->create();
      $this->be($this->user);

  }

  public function testApp()
  {
    $response = $this->call('GET', '/register');

    $this->assertEquals(200, $response->status());
  }
  public function testExample()
  {
      $this->assertTrue(true);
  }

  public function testBasicTest()
  {
    $this->visit('/register')
      ->type('Taylor', 'name')
      ->type('Taylor@test.test', 'email')
      ->type('Taylor123', 'password')
      ->type('Taylor123', 'confirm password')
      ->check('terms')
      ->press('Register')
      ->seePageIs('/dashboard');
  }

  public function tearDown()
  {
      DB::rollback();
      DB::commit();
  }
}
