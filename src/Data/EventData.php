<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\EventData as DataEventData;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerFlattenData;
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
        public ?string $reference_type = null,

        #[MapInputName('reference_id')]
        #[MapName('reference_id')]
        public mixed $reference_id = null,

        #[MapInputName('inited_at')]
        #[MapName('inited_at')]
        #[DateFormat('Y-m-d')]
        public string $inited_at,

        #[MapInputName('started_at')]
        #[MapName('started_at')]
        #[DateFormat('Y-m-d')]
        public ?string $started_at = null,

        #[MapInputName('ended_at')]
        #[MapName('ended_at')]
        #[DateFormat('Y-m-d')]
        public ?string $ended_at = null,

        #[MapInputName('total_day')]
        #[MapName('total_day')]
        public ?string $total_day = null,

        #[MapInputName('status')]
        #[MapName('status')]
        public ?string $status = Status::DRAFT->value,

        #[MapInputName('worker')]
        #[MapName('worker')]
        public ?WorkerFlattenData $worker = null,

        #[MapInputName('props')]
        #[MapName('props')]
        public ?array $props = []
    ){}
}