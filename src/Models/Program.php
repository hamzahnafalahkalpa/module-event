<?php

namespace Hanafalah\ModuleEvent\Models;

use Hanafalah\ModuleEvent\Models\Event\Event;
use Hanafalah\ModuleEvent\Resources\Program\{
    ViewProgram,
    ShowProgram
};

class Program extends Event
{
    protected $table = 'events';

    protected $casts = [
        'name' => 'string'
    ];

    public function showUsingRelation(): array{
        return $this->mergeArray(parent::showUsingRelation(),[
            'activities'
        ]);
    }

    public function getViewResource(){
        return ViewProgram::class;
    }

    public function getShowResource(){
        return ShowProgram::class;
    }
}
