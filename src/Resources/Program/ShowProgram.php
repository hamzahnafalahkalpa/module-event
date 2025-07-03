<?php

namespace Hanafalah\ModuleEvent\Resources\Program;

use Hanafalah\ModuleEvent\Resources\Event\ShowEvent;

class ShowProgram extends ViewProgram
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
      'activities' => $this->relationValidation('activities',function(){
        return $this->activities->transform(function($activity){
          return $activity->toViewApi()->resolve();
        });
      })
    ];
    $show = $this->resolveNow(new ShowEvent($this));
    $arr  = $this->mergeArray(parent::toArray($request),$show,$arr);
    return $arr;
  }
}
