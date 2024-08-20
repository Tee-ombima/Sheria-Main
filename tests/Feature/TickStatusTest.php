<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;
use Illuminate\Support\Facades\Auth;

class TickStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_personal_info_tick_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // No personal info submitted yet
        $response = $this->get('/profile');
        $response->assertSee('id="personal-info-status" class="status-icon text-red-500"', false);
        $response->assertDontSee('id="personal-info-status" class="status-icon text-green-500"', false);

        // Submit personal info
        PersonalInfo::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/profile');
        $response->assertSee('id="personal-info-status" class="status-icon text-green-500"', false);
        $response->assertDontSee('id="personal-info-status" class="status-icon text-red-500"', false);
    }

    public function test_academic_info_tick_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // No academic info submitted yet
        $response = $this->get('/profile');
        $response->assertSee('id="academic-info-status" class="status-icon text-red-500"', false);
        $response->assertDontSee('id="academic-info-status" class="status-icon text-green-500"', false);

        // Submit academic info
        AcademicInfo::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/profile');
        $response->assertSee('id="academic-info-status" class="status-icon text-green-500"', false);
        $response->assertDontSee('id="academic-info-status" class="status-icon text-red-500"', false);
    }

    public function test_prof_info_tick_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // No professional info submitted yet
        $response = $this->get('/profile');
        $response->assertSee('id="prof-info-status" class="status-icon text-red-500"', false);
        $response->assertDontSee('id="prof-info-status" class="status-icon text-green-500"', false);

        // Submit professional info
        ProfInfo::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/profile');
        $response->assertSee('id="prof-info-status" class="status-icon text-green-500"', false);
        $response->assertDontSee('id="prof-info-status" class="status-icon text-red-500"', false);
    }

    public function test_relevant_courses_tick_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // No relevant courses submitted yet
        $response = $this->get('/profile');
        $response->assertSee('id="relevant-courses-status" class="status-icon text-red-500"', false);
        $response->assertDontSee('id="relevant-courses-status" class="status-icon text-green-500"', false);

        // Submit relevant courses
        RelevantCourses::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/profile');
        $response->assertSee('id="relevant-courses-status" class="status-icon text-green-500"', false);
        $response->assertDontSee('id="relevant-courses-status" class="status-icon text-red-500"', false);
    }
}
