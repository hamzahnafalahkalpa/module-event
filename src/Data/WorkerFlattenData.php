<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\WorkerFlattenData as DataWorkerFlattenData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class WorkerFlattenData extends Data implements DataWorkerFlattenData{
    #[MapInputName('project_manager')]
    #[MapName('project_manager')]
    public WorkerData $project_manager;

    #[MapInputName('site_manager')]
    #[MapName('site_manager')]
    public WorkerData $site_manager;

    #[MapInputName('event_coordinator')]
    #[MapName('event_coordinator')]
    public WorkerData $event_coordinator;

    #[MapInputName('production_teams')]
    #[MapName('production_teams')]
    #[DataCollectionOf(WorkerData::class)]
    public ?array $production_teams = [];

    #[MapInputName('creative_teams')]
    #[MapName('creative_teams')]
    #[DataCollectionOf(WorkerData::class)]
    public ?array $creative_teams;

    #[MapInputName('logistic_officers')]
    #[MapName('logistic_officers')]
    #[DataCollectionOf(WorkerData::class)]
    public ?array $logistic_officers;
}