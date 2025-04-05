<?php

namespace Hanafalah\ModuleEvent\Models\Member;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleEvent\Concerns\HasWorker;
use Hanafalah\ModuleEvent\Resources\Event\{ViewEvent, ShowEvent};
use Hanafalah\ModuleRegional\Concerns\HasAddress;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Worker extends BaseModel{
    use HasProps, HasUlids, HasAddress, HasWorker;

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
        return ViewEvent::class;
    }

    public function getShowResource(){
        return ShowEvent::class;
    }

    public function event(){return $this->belongsToModel('Event');}
    public function reference(){return $this->morphTo();}
    public function occupation(){return $this->morphTo();}
}