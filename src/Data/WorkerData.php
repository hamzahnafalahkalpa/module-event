<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerData as DataWorkerData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class WorkerData extends Data implements DataWorkerData{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('event_id')]
    #[MapName('event_id')]
    public mixed $event_id = null;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id;

    #[MapInputName('occupation_type')]
    #[MapName('occupation_type')]
    public ?string $occupation_type = null;

    #[MapInputName('occupation_id')]
    #[MapName('occupation_id')]
    public mixed $occupation_id = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;
    
    public static function after(WorkerData $data): WorkerData{
        if (isset($data->reference_id)){
            $model = app(config('database.models.'.config('module-event.reference')));
            $data->reference_type ??= $model->getMorphClass();
            $reference = $model->findOrFail($data->reference_id);
            $data->name ??= $reference->name;

        }        
        $data->props['prop_reference'] = [
            'id'   => $data->reference_id ?? null,
            'type' => $data->reference_type ?? null,
            'name' => $reference->name ?? null
        ];

        $data->props['prop_occupation'] = [
            'id'   => $data->occupation_id ?? null,
            'name' => null
        ];

        if (isset($data->occupation_id)){
            $model = app(config('database.models.'.config('module-event.occupation')));
            $data->occupation_type ??= $model->getMorphClass();
            $occupation = $model->findOrFail($data->occupation_id);
            $data->props['prop_occupation']['name'] = $occupation->name;
        }
        return $data;
    }
}