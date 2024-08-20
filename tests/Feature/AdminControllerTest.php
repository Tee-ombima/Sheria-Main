<?php

// tests/Feature/AdminControllerTest.php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Listing;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminIndex()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $listing = Listing::factory()->create();
        $application = Application::factory()->create(['job_id' => $listing->id]);

        $response = $this->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertViewHas('listings', function($listings) use ($listing) {
            return $listings->contains($listing);
        });
    }

    public function testUpdateStatus()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $application = Application::factory()->create(['job_status' => 'Processing']);
        $applicationIds = [$application->id];
        
        $response = $this->post(route('admin.updateStatus'), [
            'application_ids' => $applicationIds,
            'status' => 'Appointed',
            'remarks' => 'Remark updated'
        ]);

        $response->assertRedirect(route('admin.index'));
        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'job_status' => 'Appointed',
            'remarks' => 'Remark updated'
        ]);
    }
}
