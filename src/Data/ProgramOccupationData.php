<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Data\UnicodeData;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramOccupationData as DataProgramOccupationData;

class ProgramOccupationData extends UnicodeData implements DataProgramOccupationData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'ProgramOccupation';
        parent::before($attributes);
    }
}