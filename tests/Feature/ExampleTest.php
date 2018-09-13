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
      // $this->prepareForTests();
      DB::beginTransaction();
      $this->user = factory(User::class)->create();
      $this->be($this->user);
  }
  public function testBasicTest()
  {
    $response = $this->json(
        'POST',
        '/projects',
        ['name' => 'test']
    );
    $this->assertTrue(Project::where('name', 'test')->exists());
  }

  public function tearDown()
  {
      DB::rollback();
      DB::commit();
  }

}
