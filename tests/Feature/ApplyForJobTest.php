<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Listing;
use App\Models\Application;
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;

class ApplyForJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_apply_for_job()
    {
        $listing = Listing::factory()->create();

        $response = $this->post("/listings/{$listing->id}/apply");

        $response->assertRedirect('/login');
    }

    public function test_user_with_incomplete_sections_cannot_apply()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create();

        // Simulate user with incomplete sections
        $this->actingAs($user);
        $response = $this->post("/listings/{$listing->id}/apply");

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('applications', [
            'user_id' => $user->id,
            'job_id' => $listing->id,
        ]);
    }

    public function test_user_with_complete_sections_can_apply()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create();

        // Simulate user with complete sections
        PersonalInfo::factory()->create(['user_id' => $user->id]);
        AcademicInfo::factory()->create(['user_id' => $user->id]);
        ProfInfo::factory()->create(['user_id' => $user->id]);
        RelevantCourses::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->post("/listings/{$listing->id}/apply");

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'job_id' => $listing->id,
        ]);
    }
}
