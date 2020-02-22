<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

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
        $task = factory(Task::class)->raw(['project_id' => $project->id]);

        $this->post($project->path().'/tasks', $task);

        $this->assertDatabaseHas('tasks', $task);
        $this->assertCount(1, $project->tasks);
    }

    public function testAnUnauthenticatedUserCannotCreateTasks()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->raw();

        $this->post($project->path().'/tasks', $task);

        $this->assertCount(0, $project->tasks);
    }

    public function testATaskRequiresABody()
    {
        $request = new TaskRequest();
        $rules = $request->rules();
        $this->signIn();
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->raw(['body' => '']);

        $this->post($project->path().'/tasks', $task);

        $validator = \Validator::make($task, $rules);
        $errorKeys = $validator->errors()->keys();

        $this->assertEquals('body', $errorKeys[0]);
    }

    public function testOnlyTheOwnerCanAddATask()
    {
        $project = factory(Project::class)->create();
        $this->signIn();
        $task = factory(Task::class)->raw(['project_id' => $project->id]);

        $this->post($project->path().'/tasks', $task)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $task);
    }
}
