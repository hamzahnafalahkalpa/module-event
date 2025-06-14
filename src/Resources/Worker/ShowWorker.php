<?php

namespace Hanafalah\ModuleEvent\Resources\Worker;

class ShowWorker extends ViewWorker
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'worker'     => $this->prop_worker,
            'reference'  => $this->relationValidation('reference',function(){
                return $this->reference->toViewApi();
            }),
            'workers' => $this->relationValidation('workers',function(){
                return $this->workers->transform(function($worker){
                    return $worker->toViewApi();
                });
            })
        ];
        $arr = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
