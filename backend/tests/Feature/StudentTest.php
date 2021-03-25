<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllStudents()
    {
        factory(Student::class,5)->create();

        $response = $this->getJson('/api/students');

        $response->assertStatus(200)
                    ->assertJsonCount(5, 'data');
    }

    public function testGetStudent()
    {
        $student = factory(Student::class)->create();

        $response = $this->getJson("/api/students/{$student->id}");

        $response->assertStatus(200);
    }
}
