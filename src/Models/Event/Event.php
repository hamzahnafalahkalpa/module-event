<?php

namespace Hanafalah\ModuleEvent\Models\Project;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleRegional\Concerns\HasAddress;
use Hanafalah\ModuleTransaction\Concerns\HasTransaction;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Event extends BaseModel{
    use HasProps, HasUlids, HasAddress, HasTransaction;

    protected $list = [
        'id', 'name' , 'reference_type', 'reference_id', 'props'
    ];

    public function reference(){return $this->morphTo();}
}