<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testItHasAPath()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals('/projects/'.$project->id, $project->path());
    }
}
