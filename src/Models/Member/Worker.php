<?php

namespace Hanafalah\ModuleEvent\Models\Member;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleEvent\Resources\Worker\{ViewWorker, ShowWorker};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Worker extends BaseModel{
    use HasUlids, HasProps;

    public $incrementing  = false;
    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    protected $list       = [
        'id', 'name', 'event_id', 
        'reference_type', 'reference_id', 
        'occupation_type','occupation_id', 
        'props'
    ];

    public function getViewResource(){
        return ViewWorker::class;
    }

    public function getShowResource(){
        return ShowWorker::class;
    }

    public function event(){return $this->belongsToModel('Event');}
    public function reference(){return $this->morphTo();}
    public function occupation(){return $this->morphTo();}
}