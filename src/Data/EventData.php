<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\EventData as DataEventData;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerFlattenData;
use Hanafalah\ModuleEvent\Enums\Event\Status;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Illuminate\Support\Str;

class EventData extends Data implements DataEventData{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id = null;

    #[MapInputName('inited_at')]
    #[MapName('inited_at')]
    #[DateFormat('Y-m-d')]
    public string $inited_at;

    #[MapInputName('started_at')]
    #[MapName('started_at')]
    #[DateFormat('Y-m-d')]
    public ?string $started_at = null;

    #[MapInputName('ended_at')]
    #[MapName('ended_at')]
    #[DateFormat('Y-m-d')]
    public ?string $ended_at = null;

    #[MapInputName('total_day')]
    #[MapName('total_day')]
    public ?string $total_day = null;

    #[MapInputName('status')]
    #[MapName('status')]
    public ?string $status = Status::DRAFT->value;

    #[MapInputName('worker')]
    #[MapName('worker')]
    public ?WorkerFlattenData $worker = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = [];

    public static function after(EventData $data): EventData{
        $workers = [
            'project_manager',
            'site_manager',
            'event_coordinator',
            'production_teams',
            'creative_teams',
            'logistic_officers'
        ];
        $prop_worker = &$data->props['prop_worker'];
        foreach ($workers as $worker) {
            $data_worker = $data->worker->{$worker};
            if (is_array($data_worker)) {
                foreach ($data_worker as $each_worker) {
                    $prop_worker[$worker][] = [
                        'reference_id' => $each_worker->reference_id,
                        'reference'    => $each_worker->props['prop_reference']
                    ];                
                }
            }else{
                $prop_worker[$worker] = [
                    'reference_id' => $data_worker->reference_id,
                    'reference'    => $data_worker->props['prop_reference']
                ];
            }
        }
        return $data;
    }
}