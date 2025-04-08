<?php

namespace Hanafalah\ModuleEvent\Resources\Event;

class ShowEvent extends ViewEvent
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'worker' => $this->prop_worker
        ];
        $arr = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
