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
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\ModuleEvent\Enums\Event\Status;

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

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getEvent(): mixed{
        return static::$event_model;
    }

    public function prepareShowEvent(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getEvent();
        if (!isset($model)) {
            $id = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('id not found');

            $model = $this->eventCommon()->with($this->showUsingRelation())->firstOrFail($id);
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$event_model = $model;
    }    

    public function showEvent(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowEvent($model);
        });
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
            'status'       => $event_dto->status ?? Status::DRAFT->value
        ]);
        foreach ($event_dto->props as $key => $prop) $event->{$key} = $prop;
        $event->save();
        if (isset($event_dto->workers)){
            
        }
        return static::$event_model = $event;
    }

    public function prepareStoreEvent(EventData $event_dto): Model{
        return $this->prepareStore($event_dto);
    }

    public function storeEvent(? EventData $event_dto = null): array{
        return $this->transaction(function () use ($event_dto) {
            return $this->showEvent($this->prepareStoreEvent($event_dto ?? $this->requestDTO(EventData::class)));
        });
    }

    public function prepareViewEventPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->eventCommon()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewEventPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewEventPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewEventList(): Collection{
        return $this->eventCommon()->with($this->viewUsingRelation())->get();
    }

    public function viewEventList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewEventList();
        });
    }

    public function prepareDeleteEvent(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])){
            throw new \Exception('id not found');
        }
        $event = $this->eventCommon()->findOrFail($attributes['id']);
        return $event->delete();
    }

    public function deleteEvent(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteEvent();
        });
    }

    public function eventCommon(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->EventModel()->conditionals($this->mergeCondition($this->mergeCondition($conditionals ?? [])))->withParameters('or')->orderBy('created_at','desc');
    }
}

