<?php

namespace Hanafalah\ModuleEvent\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleEvent\Contracts\Data\ProgramData as DataProgramData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ProgramData extends Data implements DataProgramData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('parent_id')]
    #[MapName('parent_id')]
    public mixed $parent_id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('program_category_id')]
    #[MapName('program_category_id')]
    public mixed $program_category_id;

    #[MapInputName('flag')]
    #[MapName('flag')]
    public ?string $flag = null;

    #[MapInputName('nominal')]
    #[MapName('nominal')]
    public ?string $nominal = null;

    #[MapInputName('event')]
    #[MapName('event')]
    public EventData $event;

    #[MapInputName('activity_lists')]
    #[MapName('activity_lists')]
    public ?ActivityListData $activity_lists = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;

    public static function before(array &$attributes){
        $attributes['flag'] ??= 'Program';
    }

    public static function after(self $data): self{
        $new = self::new();
        $props = &$data->props;

        $program_category = $new->ProgramCategoryModel()->findOrFail($data->program_category_id);
        $props['prop_program_category'] = $program_category->toViewApi()->resolve();

        return $data;
    }
}