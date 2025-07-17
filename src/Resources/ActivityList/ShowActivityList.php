<?php

namespace Hanafalah\ModuleEvent\Resources\ActivityList;

use Hanafalah\ModuleEvent\Resources\Program\ShowProgram;

class ShowActivityList extends ViewActivityList
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [];
    $show = $this->resolveNow(new ShowProgram($this));
    $arr = $this->mergeArray(parent::toArray($request),$show,$arr);
    return $arr;
  }
}
