<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Concerns\Support\HasRequestData;
use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\EventData as DataEventData;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerFlattenData;
use Hanafalah\ModuleEvent\Enums\Event\Status;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class EventData extends Data implements DataEventData{
    use HasRequestData;

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
    public ?string $inited_at = null;

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
    public object|array|null $worker = null;

    #[MapInputName('workers')]
    #[MapName('workers')]
    #[DataCollectionOf(WorkerData::class)]
    public ?array $workers = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = [];

    public static function after(EventData $data): EventData{
        if (isset($data->worker)){
            $new = static::new();
            
            $prop_worker = &$data->props['prop_worker'];
            foreach($data->worker as $key => &$worker){
                $worker = $new->requestDTO(WorkerData::class,$worker);
                if (is_array($worker)) {
                    foreach ($worker as $each_worker) {
                        $prop_worker[$key][] = [
                            'reference_id' => $each_worker->reference_id,
                            'reference'    => $each_worker->props['prop_reference']
                        ];                
                    }
                }else{
                    $prop_worker[$key] = [
                        'reference_id' => $worker->reference_id,
                        'reference'    => $worker->props['prop_reference']
                    ];
                }
            }
        }
        return $data;
    }
}