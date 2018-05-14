<?php

declare(strict_types=1);

namespace NAttreid\BingApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\BingApi\Hooks\BingApiConfig;
use NAttreid\BingApi\Hooks\BingApiHook;
use NAttreid\BingApi\IBingApiFactory;
use NAttreid\BingApi\BingApi;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\CompilerExtension;
use Nette\DI\Statement;

/**
 * Class AbstractBingApiExtension
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class AbstractBingApiExtension extends CompilerExtension
{
	private $defaults = [
		'tagId' => null
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());

		$bingApi = $this->prepareHook($config);

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(IBingApiFactory::class)
			->setFactory(BingApi::class)
			->setArguments([$bingApi]);
	}

	protected function prepareHook(array $config)
	{
		$bingConfig = new BingApiConfig;
		$bingConfig->tagId = $config['tagId'];
		return $bingConfig;
	}
}