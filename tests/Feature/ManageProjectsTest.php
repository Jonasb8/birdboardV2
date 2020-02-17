<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Http\Requests\ProjectRequest;
use Validator;
use App\Models\Project;
use App\Models\User;

class ManageProjectsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->request = new ProjectRequest();
        $this->rules = $this->request->getRules();
    }

    public function testAUserCanCreateAProject()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $project = factory(Project::class)->raw();

        $this->post('projects', $project);

        $this->assertDatabaseHas('projects', $project);
    }

    public function testAProjectRequiresATitle()
    {
        $project = factory(Project::class)->raw(['title' => '']);

        $this->post('projects', $project);

        $validator = Validator::make($project, $this->rules);
        $errorKeys = $validator->errors()->keys();

        $this->assertEquals('title', $errorKeys[0]);
    }

    public function testAProjectRequiresADescription()
    {
        $project = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $project);

        $validator = Validator::make($project, $this->rules);
        $errorKeys = $validator->errors()->keys();

        $this->assertEquals('description', $errorKeys[0]);
    }

    public function testAProjectRequiresAnOwner()
    {
        $project = factory(Project::class)->raw(['owner_id' => null]);

        $this->post('/projects', $project);

        $validator = Validator::make($project, $this->rules);
        $errorKeys = $validator->errors()->keys();

        $this->assertEquals('owner_id', $errorKeys[0]);
    }

    public function testAnUnsignedUserCannotSeeTheProjects()
    {
        $project = factory(Project::class)->raw();

        $this->get('/projects')->assertRedirect('/login');
    }

    public function testAnUnsignedUserCannotSeeProjectsCreateView()
    {
        $project = factory(Project::class)->raw();

        $this->get('/projects/create')->assertRedirect('/login');
    }


    public function testAUserCanViewAProject()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create();
        $this->be($user);

        $this->get('/projects/'.$project->id)
            ->assertSee($project->title);
    }

    public function testAUserCanViewHisProjects()
    {
        $users = factory(User::class, 2)->create();
        $project1 = factory(Project::class)->create(['owner_id' => $users[0]->id]);
        $project2 = factory(Project::class)->create(['owner_id' => $users[1]->id]);

        $this->be($users[0]);
        $this->get('/projects')
            ->assertSee($project1->title)
            ->assertViewMissing($project2->title);
    }

    public function testAnAuthenticatedUserCanSeeTheProjectsView()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $this->get('/projects/create')
            ->assertSee('Create a project');
    }
}
