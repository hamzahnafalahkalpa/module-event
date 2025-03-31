<?php

namespace Hanafalah\ModuleEvent\Resources\Event;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewEvent extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'              => $this->id,
            'name'            => $this->name,
        ];
        return $arr;
    }
}
