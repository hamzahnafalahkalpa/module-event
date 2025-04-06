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
            'reference_type'  => $this->reference_type, 
            'progress'        => $this->progress,
            'inited_at'       => $this->inited_at,
            'started_at'      => $this->started_at,
            'ended_at'        => $this->ended_at,
            'status'          => $this->status
        ];
        return $arr;
    }
}
