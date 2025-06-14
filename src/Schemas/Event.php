<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\{
    Builder,
    Collection,
    Model
};
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleEvent\Contracts\Schemas\Event as ContractsEvent;
use Hanafalah\ModuleEvent\Contracts\Data\EventData;
use Hanafalah\ModuleEvent\Enums\Event\Status;
use Illuminate\Support\Str;

class Event extends PackageManagement implements ContractsEvent
{
    protected string $__entity = 'Event';
    public static $event_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'event',
            'tags'     => ['event', 'event-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function camelEntity(): string{
        return Str::camel($this->__entity).'Common';
    }

    public function prepareStore(mixed $event_dto): Model{
        if (isset($event_dto->id)){
            $guard = ['id' => $event_dto->id];
        }else{
            $guard = [
                'reference_type' => $event_dto->reference_type,
                'reference_id'   => $event_dto->reference_id
            ];
        }
        $event = $this->eventCommon()->updateOrCreate($guard,[
            'inited_at'    => $event_dto->inited_at ?? null,
            'started_at'   => $event_dto->started_at ?? null,
            'ended_at'     => $event_dto->ended_at ?? null,
            'total_day'    => $event_dto->total_day ?? null,
            'status'       => $event_dto->status ?? Status::DRAFT->value
        ]);
        $this->fillingProps($event,$event_dto->props);
        $event->save();
        if (isset($event_dto->workers)){
            foreach ($event_dto->workers as &$worker){
                $worker->event_id = $event->getKey();
                $this->schemaContract('worker')->prepareStoreWorker($worker);
            }
        }
        return static::$event_model = $event;
    }

    public function prepareStoreEvent(EventData $event_dto): Model{
        return $this->prepareStore($event_dto);
    }

    public function eventCommon(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->EventModel()->conditionals($this->mergeCondition($this->mergeCondition($conditionals ?? [])))
                    ->withParameters('or')->orderBy('created_at','desc');
    }
}

