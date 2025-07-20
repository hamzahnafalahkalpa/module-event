<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\{
    Builder,
    Collection,
    Model
};
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleEvent\Contracts\Schemas\Worker as ContractsWorker;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerData;

class Worker extends PackageManagement implements ContractsWorker
{
    protected string $__entity = 'Worker';
    public $worker_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'worker',
            'tags'     => ['worker', 'worker-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStoreWorker(WorkerData $worker_dto): Model{
        $add = [
            'reference_type' => $worker_dto->reference_type,
            'reference_id'   => $worker_dto->reference_id,
            'name'           => $worker_dto->name,
            'event_id'       => $worker_dto->event_id,
            'reference_type' => $worker_dto->reference_type,
            'reference_id'   => $worker_dto->reference_id,
            'occupation_type'=> $worker_dto->occupation_type,
            'occupation_id'  => $worker_dto->occupation_id,
        ];
        if (isset($worker_dto->id)){
            $guard = ['id' => $worker_dto->id];
            $create = [$guard, $add];
        }else{
            $create = [$add];
        }
        $worker = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($worker,$worker_dto->props);
        $worker->save();
        return $this->worker_model = $worker;
    }
}

