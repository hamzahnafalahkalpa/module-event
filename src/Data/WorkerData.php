<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerData as DataWorkerData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class WorkerData extends Data implements DataWorkerData{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,

        #[MapInputName('name')]
        #[MapName('name')]
        public ?string $name = null,

        #[MapInputName('event_id')]
        #[MapName('event_id')]
        public mixed $event_id = null,

        #[MapInputName('reference_type')]
        #[MapName('reference_type')]
        public ?string $reference_type = null,

        #[MapInputName('reference_id')]
        #[MapName('reference_id')]
        public mixed $reference_id,

        #[MapInputName('occupation_type')]
        #[MapName('occupation_type')]
        public ?string $occupation_type = null,

        #[MapInputName('occupation_id')]
        #[MapName('occupation_id')]
        public mixed $occupation_id = null,

        #[MapInputName('props')]
        #[MapName('props')]
        public ?array $props = null
    ){
        if (isset($this->reference_id)){
            $this->reference_type ??= 'Employee';
        }        
        $reference = $this->{$this->reference_type.'Model'}()::find($this->reference_id);
        $this->props['prop_reference'] = [
            'type' => $this->reference_type,
            'id'   => $this->reference_id,
            'name' => $reference->name
        ];
    }
}