<?php

namespace Hanafalah\ModuleEvent\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\LaravelSupport\Models\Unicode\Unicode;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleEvent\Resources\ProgramCategory\{
    ViewProgramCategory,
    ShowProgramCategory
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ProgramCategory extends Unicode
{
    protected $table = 'unicodes';
    
    public function getViewResource(){
        return ViewProgramCategory::class;
    }

    public function getShowResource(){
        return ShowProgramCategory::class;
    }
}
