<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAUserCanCreateAProject()
    {
        $this->withoutExceptionHandling();
        $project = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('projects', $project);

        $this->assertDatabaseHas('projects', $project);
    }
}
