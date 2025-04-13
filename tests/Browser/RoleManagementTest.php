<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RoleManagementTest extends DuskTestCase
{
    public function test_permissions_modal_interaction()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/role-management')
                ->click('@permissions-button-'.$user->id)
                ->waitFor('#permissionsModal')
                ->check('permissions[]@manage_users')
                ->press('Save Changes')
                ->waitForText('Permissions updated')
                ->assertChecked('permissions[]@manage_users');
        });
    }
}