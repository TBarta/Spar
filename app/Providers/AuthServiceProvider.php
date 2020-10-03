<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\UserHasGroup;
use App\GroupArticles;
use App\Photo;
use App\Trainer;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('group_admin', function($user, $group) {
            return UserHasGroup::where('user_id', $user->id)->where('group_id', $group->id)->where('is_group_admin', 1)->count() > 0;
        });

        Gate::define("article_editor", function($user, $article) {
           return GroupArticles::where("user_id", $user->id)->where("id", $article->id)->count() > 0;
        });
        Gate::define("photo_editor", function($user, $photo) {
            return Photo::where("user_id", $user->id)->where("id", $photo->id)->count() > 0;
         });
         Gate::define("trainer", function($user) {
            return Trainer::where("user_id", $user->id)->where("registered", 1)->count() > 0;
         });
    }
}
