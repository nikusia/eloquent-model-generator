<?php

namespace nikusia\EloquentModelGenerator\Processor;

use nikusia\EloquentModelGenerator\Config;
use nikusia\EloquentModelGenerator\Model\EloquentModel;

/**
 * Interface ProcessorInterface
 * @package nikusia\EloquentModelGenerator\Processor
 */
interface ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(EloquentModel $model, Config $config);

    /**
     * @return int
     */
    public function getPriority();
}
