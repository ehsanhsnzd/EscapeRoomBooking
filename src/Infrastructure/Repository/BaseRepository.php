<?php


namespace Infrastructure\Repository;


use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{


    protected Model $model;
    private Application $app;


    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->model = $this->makeModel();
    }


    /**
     * @return Model
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        $model->setConnection($this->connection() ?? config('database.default'));

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @return mixed
     */
    abstract public function model();


    /**
     * @return mixed
     */
    abstract public function connection();


}
