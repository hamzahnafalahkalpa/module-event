<?php

namespace Hanafalah\ModuleEvent\Resources\Event;

class ShowEvent extends ViewEvent
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $arr = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
