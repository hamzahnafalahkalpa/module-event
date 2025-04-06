<?php

namespace Hanafalah\ModuleEvent\Models\Event;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleEvent\Concerns\HasWorker;
use Hanafalah\ModuleEvent\Resources\Event\{ViewEvent, ShowEvent};
use Hanafalah\ModuleRegional\Concerns\HasAddress;
use Hanafalah\ModuleTransaction\Concerns\HasTransaction;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Event extends BaseModel{
    use HasProps, HasUlids, HasAddress, HasTransaction, HasWorker;

    public $incrementing  = false;
    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    protected $list = [
        'id', 'name', 'reference_type', 'reference_id', 'progress',
        'inited_at', 'started_at', 'ended_at', 'status','props'
    ];

    public function getViewResource(){
        return ViewEvent::class;
    }

    public function getShowResource(){
        return ShowEvent::class;
    }

    public function reference(){return $this->morphTo();}
}