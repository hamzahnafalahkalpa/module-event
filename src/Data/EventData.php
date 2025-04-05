<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\EventData as DataEventData;
use Hanafalah\ModuleEvent\Enums\Event\Status;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class EventData extends Data implements DataEventData{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,

        #[MapInputName('name')]
        #[MapName('name')]
        public string $name,

        #[MapInputName('reference_type')]
        #[MapName('reference_type')]
        public string $reference_type,

        #[MapInputName('reference_id')]
        #[MapName('reference_id')]
        public mixed $reference_id,

        #[MapInputName('initial_date')]
        #[MapName('initial_date')]
        #[DateFormat('Y-m-d')]
        public string $initial_date,

        #[MapInputName('start_date')]
        #[MapName('start_date')]
        #[DateFormat('Y-m-d')]
        public ?string $start_date = null,

        #[MapInputName('end_date')]
        #[MapName('end_date')]
        #[DateFormat('Y-m-d')]
        public ?string $end_date = null,

        #[MapInputName('total_day')]
        #[MapName('total_day')]
        public ?string $total_day = null,

        #[MapInputName('status')]
        #[MapName('status')]
        public ?string $status = Status::DRAFT->value,

        #[MapInputName('workers')]
        #[MapName('workers')]
        public ?WorkerFlattenData $workers = null,

        #[MapInputName('props')]
        #[MapName('props')]
        public ?array $props = []
    ){}
}