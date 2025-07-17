<?php

namespace Hanafalah\ModuleEvent\Models;

use Hanafalah\ModuleEvent\Resources\ActivityList\{
    ViewActivityList,
    ShowActivityList
};

class ActivityList extends Program
{
    protected $table = 'programs';

    public function getViewResource(){
        return ViewActivityList::class;
    }

    public function getShowResource(){
        return ShowActivityList::class;
    }
}
