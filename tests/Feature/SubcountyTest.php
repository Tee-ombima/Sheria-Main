<?php

namespace Tests\Feature;

use App\Models\Constituency;
use App\Models\Homecounty;
use App\Models\Subcounty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubcountyTest extends TestCase
{
    use RefreshDatabase;

    public function test_subcounties_are_fetched_based_on_constituency()
    {
        // Set up test data
        $homecounty = Homecounty::factory()->create();
        $constituency = Constituency::factory()->create(['homecounty_id' => $homecounty->id]);
        $subcounty = Subcounty::factory()->create(['homecounty_id' => $homecounty->id]);

        // Hit the API endpoint
        $response = $this->getJson('/api/subcounties?constituency=' . $constituency->name);

        // Assert the correct data is returned
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => $subcounty->name]);
    }
}
