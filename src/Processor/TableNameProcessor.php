<?php

namespace nikusia\EloquentModelGenerator\Processor;

use nikusia\CodeGenerator\Model\ClassNameModel;
use nikusia\CodeGenerator\Model\DocBlockModel;
use nikusia\CodeGenerator\Model\PropertyModel;
use nikusia\CodeGenerator\Model\UseClassModel;
use nikusia\EloquentModelGenerator\Config;
use nikusia\EloquentModelGenerator\Helper\EmgHelper;
use nikusia\EloquentModelGenerator\Model\EloquentModel;

/**
 * Class TableNameProcessor
 * @package nikusia\EloquentModelGenerator\Processor
 */
class TableNameProcessor implements ProcessorInterface
{
    /**
     * @var EmgHelper
     */
    protected $helper;

    /**
     * TableNameProcessor constructor.
     * @param EmgHelper $helper
     */
    public function __construct(EmgHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @inheritdoc
     */
    public function process(EloquentModel $model, Config $config)
    {
        $className     = $config->get('class_name');
        $baseClassName = $config->get('base_class_name');
        $tableName     = $config->get('table_name');

        $model->setName(new ClassNameModel($className, $this->helper->getShortClassName($baseClassName)));
        $model->addUses(new UseClassModel(ltrim($baseClassName, '\\')));
        $model->setTableName($tableName ?: $this->helper->getDefaultTableName($className));

        if ($model->getTableName() !== $this->helper->getDefaultTableName($className)) {
            $property = new PropertyModel('table', 'protected', $model->getTableName());
            $property->setDocBlock(new DocBlockModel('The table associated with the model.', '', '@var string'));
            $model->addProperty($property);
        }
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 10;
    }
}
