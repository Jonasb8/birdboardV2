<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAProjectCanHaveTasks()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);
        $task = [
            'body' => 'toto',
        ];

        $this->post('/projects/'.$project->id.'/tasks', $task);

        $this->assertDatabaseHas('tasks', $task);
        $this->assertCount(1, $project->tasks);
    }

    public function testAnUnauthenticatedUserCannotCreateTasks()
    {
        $project = factory(Project::class)->create();
        $task = [
            'body' => 'toto',
        ];

        $this->post('/projects/'.$project->id.'/tasks', $task);

        $this->assertCount(0, $project->tasks);
    }
}
