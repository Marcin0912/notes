<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-note', function (User $user, Note $note) {
            return $user->id === $note->user_id;
        });
        Gate::define('delete-note', function (User $user, Note $note) {
            return $user->id === $note->user_id;
        });
    }
}
