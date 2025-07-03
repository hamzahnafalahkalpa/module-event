<?php

namespace Hanafalah\ModuleEvent\Contracts\Schemas;

use Hanafalah\ModuleEvent\Contracts\Data\ProgramData;
//use Hanafalah\ModuleEvent\Contracts\Data\ProgramUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleEvent\Schemas\Program
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateProgram(?ProgramData $program_dto = null)
 * @method Model prepareUpdateProgram(ProgramData $program_dto)
 * @method bool deleteProgram()
 * @method bool prepareDeleteProgram(? array $attributes = null)
 * @method mixed getProgram()
 * @method ?Model prepareShowProgram(?Model $model = null, ?array $attributes = null)
 * @method array showProgram(?Model $model = null)
 * @method Collection prepareViewProgramList()
 * @method array viewProgramList()
 * @method LengthAwarePaginator prepareViewProgramPaginate(PaginateData $paginate_dto)
 * @method array viewProgramPaginate(?PaginateData $paginate_dto = null)
 * @method Model prepareStoreProgram(ProgramData $program_dto)
 * @method array storeProgram(?ProgramData $program_dto = null)
 * @method Collection prepareStoreMultipleProgram(array $datas)
 * @method array storeMultipleProgram(array $datas)
 * @method Builder program(mixed $conditionals = null)
 */

interface Program extends Event{}