<?php

namespace Hanafalah\ModuleEvent\Resources\Program;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewProgram extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'id'                => $this->id,
      'parent_id'         => $this->parent_id,
      'name'              => $this->name,
      'flag'              => $this->flag,
      'nominal'           => $this->nominal,
      'event'             => $this->prop_event,
      'program_category'  => $this->prop_program_category ?? null,
      'created_at'        => $this->created_at,
      'updated_at'        => $this->updated_at
    ];
    return $arr;
  }
}
