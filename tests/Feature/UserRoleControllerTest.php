<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use PHPUnit\Framework\Assert;

class UserRoleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->superAdmin = User::factory()->create(['role' => 'superadmin']);
        Cache::clear();
    }

    // Authentication Tests
    public function test_unauthorized_access_redirects()
    {
        $user = User::factory()->create();

        // Index
        $this->get(route('admin.role-management'))->assertRedirect('/login');
        $this->actingAs($user)->get(route('admin.role-management'))->assertForbidden();
    }

    // Index Tests
    public function test_index_displays_verified_users()
    {
        $verifiedUser = User::factory()->verified()->create();
        $unverifiedUser = User::factory()->create();

        $response = $this->actingAs($this->superAdmin)
            ->get(route('admin.role-management'))
            ->assertOk();

        $response->assertSee($verifiedUser->email);
        $response->assertDontSee($unverifiedUser->email);
    }

    public function test_search_functionality()
    {
        $user1 = User::factory()->verified()->create(['email' => 'test1@example.com']);
        $user2 = User::factory()->verified()->create(['email' => 'another@test.com']);

        $response = $this->actingAs($this->superAdmin)
            ->get(route('admin.role-management', ['search' => 'test1']))
            ->assertOk();

        $response->assertSee($user1->email);
        $response->assertDontSee($user2->email);
    }

    // Toggle Role Tests
    public function test_toggle_role_functionality()
    {
        $admin = User::factory()->verified()->create(['role' => 'admin']);
        $user = User::factory()->verified()->create(['role' => 'user']);

        // Admin to user
        $this->actingAs($this->superAdmin)
            ->post(route('admin.role-management.toggleRole', $admin))
            ->assertRedirect()
            ->assertSessionHas('message');

        $this->assertEquals('user', $admin->fresh()->role);

        // User to admin
        $this->actingAs($this->superAdmin)
            ->post(route('admin.role-management.toggleRole', $user));

        $this->assertEquals('admin', $user->fresh()->role);
    }

    public function test_cannot_toggle_superadmin_role()
    {
        $anotherSuperAdmin = User::factory()->create(['role' => 'superadmin']);

        $this->actingAs($this->superAdmin)
            ->post(route('admin.role-management.toggleRole', $anotherSuperAdmin))
            ->assertRedirect()
            ->assertSessionHas('error');

        $this->assertEquals('superadmin', $anotherSuperAdmin->fresh()->role);
    }

    // Delete Tests
    public function test_user_deletion()
    {
        $user = User::factory()->verified()->admin()->create();

        $this->actingAs($this->superAdmin)
            ->delete(route('admin.users.destroy', $user))
            ->assertRedirect()
            ->assertSessionHas('message');

        $this->assertSoftDeleted($user);
    }

    public function test_deletion_updates_caches()
    {
        Cache::put('total_users', 5, 3600);
        Cache::put('verified_users', 3, 3600);
        Cache::put('admin_users', 2, 3600);

        $user = User::factory()->verified()->admin()->create();

        $this->actingAs($this->superAdmin)
            ->delete(route('admin.users.destroy', $user));

        $this->assertFalse(Cache::has('total_users'));
        $this->assertFalse(Cache::has('verified_users'));
        $this->assertFalse(Cache::has('admin_users'));
    }

    // Permissions Tests
    public function test_permissions_update()
    {
        $user = User::factory()->create();
        $permissions = ['manage_listings', 'manage_internships'];

        $this->actingAs($this->superAdmin)
            ->put(route('users.permissions.update', $user), ['permissions' => $permissions])
            ->assertRedirect()
            ->assertSessionHas('message');

        $this->assertEquals($permissions, $user->fresh()->permissions);
    }

    // Cache Tests
    public function test_statistics_caching()
    {
        User::factory()->count(3)->verified()->create();
        User::factory()->count(2)->create();
        User::factory()->count(1)->admin()->create();

        $this->actingAs($this->superAdmin)
            ->get(route('admin.role-management'));

        $this->assertEquals(6, Cache::get('total_users'));
        $this->assertEquals(3, Cache::get('verified_users'));
        $this->assertEquals(2, Cache::get('unverified_users'));
        $this->assertEquals(1, Cache::get('admin_users'));
    }

    // Add to UserRoleControllerTest

public function test_superadmin_deletion_protection()
{
    $superadmin = User::factory()->create(['role' => 'superadmin']);

    $this->actingAs($this->superAdmin)
        ->delete(route('admin.users.destroy', $superadmin))
        ->assertForbidden();

    $this->assertDatabaseHas('users', ['id' => $superadmin->id]);
}

public function test_invalid_permission_rejection()
{
    $user = User::factory()->create();

    $this->actingAs($this->superAdmin)
        ->put(route('users.permissions.update', $user), [
            'permissions' => ['invalid_permission']
        ])
        ->assertInvalid(['permissions.0']);
}
}