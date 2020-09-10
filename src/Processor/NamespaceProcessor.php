<?php

namespace nikusia\EloquentModelGenerator\Processor;

use nikusia\CodeGenerator\Model\NamespaceModel;
use nikusia\EloquentModelGenerator\Config;
use nikusia\EloquentModelGenerator\Model\EloquentModel;

/**
 * Class NamespaceProcessor
 * @package nikusia\EloquentModelGenerator\Processor
 */
class NamespaceProcessor implements ProcessorInterface
{
    /**
     * @inheritdoc
     */
    public function process(EloquentModel $model, Config $config)
    {
        $model->setNamespace(new NamespaceModel($config->get('namespace')));
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 6;
    }
}
