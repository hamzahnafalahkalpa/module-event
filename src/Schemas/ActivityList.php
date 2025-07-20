<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleEvent\Contracts\Schemas\ActivityList as ContractsActivityList;
use Hanafalah\ModuleEvent\Contracts\Data\ActivityListData;

class ActivityList extends Program implements ContractsActivityList
{
    protected string $__entity = 'ActivityList';
    public $activity_list_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'activity_list',
            'tags'     => ['activity_list', 'activity_list-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreActivityList(ActivityListData $activity_list_dto): Model{
        $activity_list = $this->prepareStoreProgram($activity_list_dto);
        $this->fillingProps($activity_list,$activity_list_dto->props);
        $activity_list->save();
        return $this->activity_list_model = $activity_list;
    }
}