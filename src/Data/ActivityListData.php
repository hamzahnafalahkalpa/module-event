<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\ModuleEvent\Contracts\Data\ActivityListData as DataActivityListData;

class ActivityListData extends ProgramData implements DataActivityListData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'ActivityList';
        parent::before($attributes);
    }
}