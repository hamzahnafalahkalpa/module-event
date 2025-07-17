<?php

namespace Hanafalah\ModuleEvent\Resources\Event;

class ShowEvent extends ViewEvent
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'worker'  => $this->prop_worker,
            'workers' => $this->relationValidation('workers',function(){
                return $this->workers->transform(function($worker){
                    return $worker->toViewApi()->resolve();
                });
            })
        ];
        $arr = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
