<?php

namespace nikusia\EloquentModelGenerator\Provider;

use Illuminate\Support\ServiceProvider;
use nikusia\EloquentModelGenerator\Command\GenerateModelCommand;
use nikusia\EloquentModelGenerator\EloquentModelBuilder;
use nikusia\EloquentModelGenerator\Processor\CustomPrimaryKeyProcessor;
use nikusia\EloquentModelGenerator\Processor\CustomPropertyProcessor;
use nikusia\EloquentModelGenerator\Processor\ExistenceCheckerProcessor;
use nikusia\EloquentModelGenerator\Processor\FieldProcessor;
use nikusia\EloquentModelGenerator\Processor\NamespaceProcessor;
use nikusia\EloquentModelGenerator\Processor\RelationProcessor;
use nikusia\EloquentModelGenerator\Processor\TableNameProcessor;

/**
 * Class GeneratorServiceProvider
 * @package nikusia\EloquentModelGenerator\Provider
 */
class GeneratorServiceProvider extends ServiceProvider
{
    const PROCESSOR_TAG = 'eloquent_model_generator.processor';

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->commands([
            GenerateModelCommand::class,
        ]);

        $this->app->tag([
            ExistenceCheckerProcessor::class,
            FieldProcessor::class,
            NamespaceProcessor::class,
            RelationProcessor::class,
            CustomPropertyProcessor::class,
            TableNameProcessor::class,
            CustomPrimaryKeyProcessor::class,
        ], self::PROCESSOR_TAG);

        $this->app->bind(EloquentModelBuilder::class, function ($app) {
            return new EloquentModelBuilder($app->tagged(self::PROCESSOR_TAG));
        });
    }
}