<?php

namespace Hanafalah\ModuleEvent\Resources\Worker;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewWorker extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'              => $this->id,
            'name'            => $this->name,
            'reference_id'    => $this->reference_id,
            'reference'       => $this->prop_reference,
            'occupation_id'   => $this->occupation_id,
            'occupation'      => $this->prop_occupation
        ];
        return $arr;
    }
}
