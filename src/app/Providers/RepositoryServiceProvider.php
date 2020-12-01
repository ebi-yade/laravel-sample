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
            \App\Repositories\BookRepository::class,
            \App\Repositories\Eloquent\EloquentBookRepository::class
        );
        $this->app->bind(
            \App\Repositories\AuthorRepository::class,
            \App\Repositories\Eloquent\EloquentAuthorRepository::class
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
