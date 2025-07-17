<?php

namespace Hanafalah\ModuleEvent\Schemas;

use Hanafalah\ModuleEvent\Contracts\Schemas\Program as ContractsProgram;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramData;
use Hanafalah\ModuleEvent\Supports\BaseModuleEvent;

class Program extends BaseModuleEvent implements ContractsProgram
{
    protected string $__entity = 'Program';
    public static $program_model;
    protected mixed $__order_by_created_at = ['created_at','desc']; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'program',
            'tags'     => ['program', 'program-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    public function prepareStoreProgram(ProgramData $program_dto): Model{
        $program = $this->usingEntity()->updateOrCreate([
            'id'        => $program_dto->id ?? null
        ],[
            'name'      => $program_dto->name,
            'flag'      => $program_dto->flag,
            'parent_id' => $program_dto->parent_id,
            'nominal'   => $program_dto->nominal
        ]);

        $program->load('event');
        $event = $program->event;

        $program_dto->id          = $program->getKey();
        $program_dto->event->id   = $event->getKey();
        $program_dto->event->name = $event->name;
        $this->schemaContract('event')->prepareStore($program_dto->event);

        if (isset($program_dto->activity_lists) && count($program_dto->activity_lists) > 0) {
            $nominal = 0;
            foreach ($program_dto->activity_lists as $activity_list) {
                $activity_list->program_id = $program->getKey();
                $activity_list = $this->schemaContract('activity_list')->prepareStoreActivityList($activity_list);
                $nominal += $activity_list->nominal;
            }
            $program->nominal = $nominal;
        }

        $this->fillingProps($program,$program_dto->props);
        $program->save();
        return static::$program_model = $program;
    }
}

