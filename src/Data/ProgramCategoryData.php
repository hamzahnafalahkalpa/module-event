<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Data\UnicodeData;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramCategoryData as DataProgramCategoryData;

class ProgramCategoryData extends UnicodeData implements DataProgramCategoryData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'ProgramCategory';
        parent::before($attributes);
    }
}