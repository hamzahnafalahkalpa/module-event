<?php

namespace Hanafalah\ModuleEvent;

use Hanafalah\LaravelSupport\Supports\PackageManagement;

class ModuleEvent extends PackageManagement implements Contracts\ModuleEvent
{
    /** @var array */
    protected $__module_event_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('module-event', $this->__module_event_config);
    }
}
