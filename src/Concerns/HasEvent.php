<?php

namespace Hanafalah\ModuleEvent\Concerns;

trait HasEvent{
    public static function bootHasEvent(){
        static::created(function($query){
            $query->event()->firstOrCreate();
        });
    }

    public function event(){return $this->morphOneModel('Event','reference');}
}