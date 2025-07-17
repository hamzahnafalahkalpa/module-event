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
      'event'      => $this->relationValidation('event',function(){
        return $this->event->toViewApi()->resolve();
      }),
      'activity_lists' => $this->relationValidation('activityLists',function(){
        return $this->activityLists->transform(function($activityList){
          return $activityList->toViewApi()->resolve();
        });
      }),
      'activities' => $this->relationValidation('activities',function(){
        return $this->activities->transform(function($activity){
          return $activity->toViewApi()->resolve();
        });
      })
    ];
    $arr  = $this->mergeArray(parent::toArray($request),$arr);
    return $arr;
  }
}
