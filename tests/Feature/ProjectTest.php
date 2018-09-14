<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Project;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ExampleTest extends TestCase
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
    $response = $this->call('GET', '/projects');

    $this->assertEquals(200, $response->status());
  }
  public function testBasicTest()
  {
    $response = $this->json(
        'POST',
        '/projects',
        ['name' => 'test']
    );

    $this->assertTrue(Project::where('name', 'test')->exists());;

    $this->withoutMiddleware();

    $this->visit('/projects')->click('Add TODO List')->seePageIs('/create');

  }

  public function tearDown()
  {
      DB::rollback();
      DB::commit();
  }

}
