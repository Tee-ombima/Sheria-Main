<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        activity()
        ->causedBy(
            Auth::check() ? Auth::user() : $user // Now properly typed
        )            ->performedOn($user)
            ->withProperties([
                'user_email' => $user->email,
                'changed_by_email' => Auth::user()?->email ?? 'system',
                'initial_permissions' => $user->permissions ?? []
            ])
            ->event('user_created')
            ->log('New user registered');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        if ($user->isDirty('permissions')) {
            $this->logPermissionChanges($user);
        }

        if ($user->isDirty('email')) {
            activity()
                ->causedBy(Auth::user())
                ->performedOn($user)
                ->withProperties([
                    'old_email' => $user->getOriginal('email'),
                    'new_email' => $user->email,
                    'changed_by_email' => Auth::user()->email
                ])
                ->event('email_updated')
                ->log('User email changed');
        }
    }

    protected function logPermissionChanges(User $user)
    {
        $oldPermissions = $user->getOriginal('permissions') ?? [];
        $newPermissions = $user->permissions ?? [];
        
        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'user_email' => $user->email,
                'admin_email' => Auth::user()->email,
                'old' => $oldPermissions,
                'new' => $newPermissions,
                'changed_by' => Auth::id()
            ])
            ->event('permissions_updated')
            ->log('User permissions updated');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user)
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'deleted_user_email' => $user->email,
                'deleted_by_email' => Auth::user()->email,
                'last_known_permissions' => $user->permissions
            ])
            ->event('user_deleted')
            ->log('User account deleted');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user)
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'restored_user_email' => $user->email,
                'restored_by_email' => Auth::user()->email
            ])
            ->event('user_restored')
            ->log('User account restored');
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user)
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'force_deleted_user_email' => $user->email,
                'deleted_by_email' => Auth::user()->email,
                'permanent_deletion' => true
            ])
            ->event('user_force_deleted')
            ->log('User permanently deleted');
    }
}