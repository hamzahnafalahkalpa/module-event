<?php

namespace Hanafalah\ModuleEvent\Supports;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class BaseModuleEvent extends PackageManagement implements DataManagement
{
    protected $__config_name = 'module-event';
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
        $this->setConfig($this->__config_name, $this->__module_event_config);
    }
}
