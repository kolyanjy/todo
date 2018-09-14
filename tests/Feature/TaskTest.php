<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
  public function setUp()
  {
    parent::setUp();
    Session::start();
    DB::beginTransaction();
    $this->user = factory(User::class)->create();
    $this->be($this->user);

  }

    public function testExample()
    {
      $this->visit('/projects')
        ->type('Test-task', 'name')
        ->press('Register')
        ->seePageIs('/dashboard');
    }


  public function tearDown()
  {
    DB::rollback();
    DB::commit();
  }
}
