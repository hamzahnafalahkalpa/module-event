<?php

namespace Hanafalah\ModuleEvent\Concerns;

trait HasEvent{
    public static function bootHasEvent(){
        static::created(function ($query) {
            $query->event()->firstOrCreate([
                'reference_id'   => $query->getKey(),
                'reference_type' => $query->getMorphClass()
            ], [
                'name' => $query->name
            ]);
        });

        static::updating(function ($query) {
            $query->event()->updateOrCreate([
                'reference_id'   => $query->getKey(),
                'reference_type' => $query->getMorphClass()
            ], [
                'name' => $query->name
            ]);
        });
    }

    public function event(){return $this->morphOneModel('Event','reference');}
}