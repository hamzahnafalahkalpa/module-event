<?php

namespace Hanafalah\ModuleEvent\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleEvent\Contracts\Data\EventData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleEvent\Schemas\Event
 * @method self conditionals(mixed $conditionals)
 * @method mixed export(string $type)
 * @method bool deleteEvent()
 * @method bool prepareDeleteEvent(? array $attributes = null)
 * @method mixed getEvent()
 * @method ?Model prepareShowEvent(?Model $model = null, ?array $attributes = null)
 * @method array showEvent(?Model $model = null)
 * @method Collection prepareViewEventList()
 * @method array viewEventList()
 * @method LengthAwarePaginator prepareViewEventPaginate(PaginateData $paginate_dto)
 * @method array viewEventPaginate(?PaginateData $paginate_dto = null)
 * @method array storeEvent(?EventData $event_dto = null)
 */
interface Event extends DataManagement{
    public function camelEntity(): string;
    public function prepareStore(mixed $event_dto): Model;
    public function prepareStoreEvent(EventData $event_dto): Model;
    public function eventCommon(mixed $conditionals = null): Builder;

}