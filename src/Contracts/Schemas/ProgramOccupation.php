<?php

namespace Hanafalah\ModuleEvent\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Schemas\Unicode;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramOccupationData;
//use Hanafalah\ModuleEvent\Contracts\Data\ProgramOccupationUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleEvent\Schemas\ProgramOccupation
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateProgramOccupation(?ProgramOccupationData $program_occupation_dto = null)
 * @method Model prepareUpdateProgramOccupation(ProgramOccupationData $program_occupation_dto)
 * @method bool deleteProgramOccupation()
 * @method bool prepareDeleteProgramOccupation(? array $attributes = null)
 * @method mixed getProgramOccupation()
 * @method ?Model prepareShowProgramOccupation(?Model $model = null, ?array $attributes = null)
 * @method array showProgramOccupation(?Model $model = null)
 * @method Collection prepareViewProgramOccupationList()
 * @method array viewProgramOccupationList()
 * @method LengthAwarePaginator prepareViewProgramOccupationPaginate(PaginateData $paginate_dto)
 * @method array viewProgramOccupationPaginate(?PaginateData $paginate_dto = null)
 * @method array storeProgramOccupation(?ProgramOccupationData $program_occupation_dto = null)
 * @method Collection prepareStoreMultipleProgramOccupation(array $datas)
 * @method array storeMultipleProgramOccupation(array $datas)
 */

interface ProgramOccupation extends Unicode
{
    public function prepareStoreProgramOccupation(ProgramOccupationData $program_occupation_dto): Model;
    public function programOccupation(mixed $conditionals = null): Builder;
}