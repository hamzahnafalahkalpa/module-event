<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Hanafalah\LaravelSupport\Schemas\Unicode;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleEvent\Contracts\Schemas\ProgramCategory as ContractsProgramCategory;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramCategoryData;
use Illuminate\Database\Eloquent\Builder;

class ProgramCategory extends Unicode implements ContractsProgramCategory
{
    protected string $__entity = 'ProgramCategory';
    public $program_category_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'program_category',
            'tags'     => ['program_category', 'program_category-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreProgramCategory(ProgramCategoryData $program_category_dto): Model{
        $program_category = $this->prepareStoreUnicode($program_category_dto);
        return $this->program_category_model = $program_category;
    }

    public function programCategory(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}