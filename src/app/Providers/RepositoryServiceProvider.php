<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true; // 必要な時のみロードするように設定

    /**
     * Repositoryインターフェースの呼び出しとGatewayを紐付ける
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Domain\Repositories\BookRepository::class,
            \App\Eloquent\BookRepository::class
        );
        $this->app->bind(
            \App\Domain\Repositories\AuthorRepository::class,
            \App\Eloquent\AuthorRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
