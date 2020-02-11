<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\ProjectRequest;
use Validator;
use App\Models\Project;
use App\Models\User;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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
        $this->actingAs(factory(User::class)->create());
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

    public function testAUserCanViewAllProjects()
    {
        $projects = factory(Project::class, 4)->create();

        $this->get('/projects')
            ->assertSee($projects[0]->title)
            ->assertSee($projects[1]->title)
            ->assertSee($projects[2]->title)
            ->assertSee($projects[3]->title);
    }

    public function testAUserCanViewAProject()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects/'.$project->id)
            ->assertSee($project->title);
    }
}
