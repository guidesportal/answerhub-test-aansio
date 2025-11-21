<?php

namespace App\Providers;

use App\Infrastructure\Eloquent\Repositories\EloquentAnswerRepository;
use App\Infrastructure\Eloquent\Repositories\EloquentQuestionRepository;
use App\Infrastructure\Eloquent\Repositories\EloquentSurveyRepository;
use App\Infrastructure\Eloquent\Repositories\EloquentUserRepository;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\SurveyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\Surveys\SurveyAnswerService;
use App\Services\Surveys\SurveyAnswerServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AnswerRepositoryInterface::class, EloquentAnswerRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, EloquentQuestionRepository::class);
        $this->app->bind(SurveyRepositoryInterface::class, EloquentSurveyRepository::class);
        $this->app->bind(SurveyAnswerServiceInterface::class, SurveyAnswerService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
