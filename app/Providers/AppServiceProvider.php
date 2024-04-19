<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\Department\DepartmentRepository;
use App\Repositories\Project\ProjectInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Invoice\InvoiceInterface;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Designation\DesignationInterface;
use App\Repositories\Designation\DesignationRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Task\TaskInterface;
use App\Repositories\Task\TaskRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(ClientInterface::class, ClientRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);
        $this->app->bind(InvoiceInterface::class, InvoiceRepository::class);
        $this->app->bind(DesignationInterface::class, DesignationRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
