<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testTaskPath()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->create(['project_id' => $project->id]);

        $this->assertEquals('/projects/'.$project->id.'/tasks/'.$task->id, $task->path());
    }
}
