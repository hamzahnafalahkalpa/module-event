<?php

namespace Hanafalah\ModuleEvent\Contracts\Schemas;

use Hanafalah\ModuleEvent\Contracts\Data\ActivityListData;
//use Hanafalah\ModuleEvent\Contracts\Data\ActivityListUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleEvent\Schemas\ActivityList
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateActivityList(?ActivityListData $activity_list_dto = null)
 * @method Model prepareUpdateActivityList(ActivityListData $activity_list_dto)
 * @method bool deleteActivityList()
 * @method bool prepareDeleteActivityList(? array $attributes = null)
 * @method mixed getActivityList()
 * @method ?Model prepareShowActivityList(?Model $model = null, ?array $attributes = null)
 * @method array showActivityList(?Model $model = null)
 * @method Collection prepareViewActivityListList()
 * @method array viewActivityListList()
 * @method LengthAwarePaginator prepareViewActivityListPaginate(PaginateData $paginate_dto)
 * @method array viewActivityListPaginate(?PaginateData $paginate_dto = null)
 * @method array storeActivityList(?ActivityListData $activity_list_dto = null)
 * @method Collection prepareStoreMultipleActivityList(array $datas)
 * @method array storeMultipleActivityList(array $datas)
 */

interface ActivityList extends Program
{
    public function prepareStoreActivityList(ActivityListData $activity_list_dto): Model;
}