<?php

declare(strict_types=1);

namespace NAttreid\BingApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\BingApi\Hooks\BingApiConfig;
use NAttreid\BingApi\Hooks\BingApiHook;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\Statement;

if (trait_exists('NAttreid\Cms\DI\ExtensionTranslatorTrait')) {
	class BingApiExtension extends AbstractBingApiExtension
	{
		use ExtensionTranslatorTrait;

		protected function prepareConfig(array $config)
		{
			$builder = $this->getContainerBuilder();
			$hook = $builder->getByType(HookService::class);
			if ($hook) {
				$builder->addDefinition($this->prefix('bingApiHook'))
					->setType(BingApiHook::class);

				$this->setTranslation(__DIR__ . '/../lang/', [
					'webManager'
				]);

				return new Statement('?->bingApi \?: new ' . BingApiConfig::class, ['@' . Configurator::class]);
			} else {
				return parent::prepareConfig($config);
			}
		}
	}
} else {
	class BingApiExtension extends AbstractBingApiExtension
	{
	}
}