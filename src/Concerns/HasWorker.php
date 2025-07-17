<?php

namespace Hanafalah\ModuleEvent\Concerns;

trait HasWorker{
    public function worker(){return $this->hasOneModel('Worker');}
}