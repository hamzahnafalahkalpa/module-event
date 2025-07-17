<?php

namespace Hanafalah\ModuleEvent\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Schemas\Unicode;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramCategoryData;
//use Hanafalah\ModuleEvent\Contracts\Data\ProgramCategoryUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleEvent\Schemas\ProgramCategory
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateProgramCategory(?ProgramCategoryData $program_category_dto = null)
 * @method Model prepareUpdateProgramCategory(ProgramCategoryData $program_category_dto)
 * @method bool deleteProgramCategory()
 * @method bool prepareDeleteProgramCategory(? array $attributes = null)
 * @method mixed getProgramCategory()
 * @method ?Model prepareShowProgramCategory(?Model $model = null, ?array $attributes = null)
 * @method array showProgramCategory(?Model $model = null)
 * @method Collection prepareViewProgramCategoryList()
 * @method array viewProgramCategoryList()
 * @method LengthAwarePaginator prepareViewProgramCategoryPaginate(PaginateData $paginate_dto)
 * @method array viewProgramCategoryPaginate(?PaginateData $paginate_dto = null)
 * @method array storeProgramCategory(?ProgramCategoryData $program_category_dto = null)
 * @method Collection prepareStoreMultipleProgramCategory(array $datas)
 * @method array storeMultipleProgramCategory(array $datas)
 */

interface ProgramCategory extends Unicode
{
    public function prepareStoreProgramCategory(ProgramCategoryData $program_category_dto): Model;
}