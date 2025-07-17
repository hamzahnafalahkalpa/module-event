<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Hanafalah\LaravelSupport\Schemas\Unicode;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleEvent\Contracts\Schemas\ProgramOccupation as ContractsProgramOccupation;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramOccupationData;
use Illuminate\Database\Eloquent\Builder;

class ProgramOccupation extends Unicode implements ContractsProgramOccupation
{
    protected string $__entity = 'ProgramOccupation';
    public static $program_occupation_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'program_occupation',
            'tags'     => ['program_occupation', 'program_occupation-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreProgramOccupation(ProgramOccupationData $program_occupation_dto): Model{
        $program_occupation = $this->prepareStoreUnicode($program_occupation_dto);
        return static::$program_occupation_model = $program_occupation;
    }

    public function programOccupation(mixed $conditionals = null): Builder{
        return $this->unicode();
    }
}