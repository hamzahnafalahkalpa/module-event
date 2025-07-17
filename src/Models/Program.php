<?php

namespace Hanafalah\ModuleEvent\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleEvent\Concerns\HasEvent;
use Hanafalah\ModuleEvent\Resources\Program\{
    ViewProgram, ShowProgram
};
use Hanafalah\ModuleWarehouse\Concerns\Stock\HasWarehouseStock;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;

class Program extends BaseModel{
    use HasUlids, HasEvent, HasProps, HasWarehouseStock;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $list = [
        'id', 'parent_id', 'program_code', 'flag', 'name', 'nominal', 'props'
    ];

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('flag',function($query){
            $query->flagIn((new static)->getMorphClass());
        });
        static::creating(function($query){
            $morph = $query->getMorphClass();
            $query->{Str::snake($morph).'_code'} = static::hasEncoding(Str::upper(Str::snake($morph)));
            $query->flag ??= $morph;
        });
    }

    public function viewUsingRelation(): array{
        return [
            'event'
        ];
    }

    public function showUsingRelation(): array{
        return [
            'activityLists',
            'event.workers'
        ];
    }

    public function getViewResource(){
        return ViewProgram::class;
    }

    public function getShowResource(){
        return ShowProgram::class;
    }

    public function activityLists(){return $this->hasManyModel('ActivityList','parent_id');}
}