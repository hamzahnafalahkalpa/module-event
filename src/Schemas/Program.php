<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleEvent\{
    Supports\BaseModuleEvent
};
use Hanafalah\ModuleEvent\Contracts\Schemas\Program as ContractsProgram;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramData;

class Program extends Event implements ContractsProgram
{
    protected string $__entity = 'Program';
    public static $program_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'program',
            'tags'     => ['program', 'program-index'],
            'duration' => 24 * 60
        ]
    ];

}