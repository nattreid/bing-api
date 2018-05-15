<?php

declare(strict_types=1);

namespace NAttreid\BingApi\Hooks;

use NAttreid\Form\Form;
use NAttreid\WebManager\Services\Hooks\HookFactory;
use Nette\ComponentModel\Component;
use Nette\Utils\ArrayHash;

/**
 * Class BingApiHook
 *
 * @author Attreid <attreid@gmail.com>
 */
class BingApiHook extends HookFactory
{
	/** @var IConfigurator */
	protected $configurator;

	public function init(): void
	{
		$this->latte = __DIR__ . '/bingApiHook.latte';

		if (!$this->configurator->bingApi) {
			$this->configurator->bingApi = new BingApiConfig;
		}
	}

	/** @return Component */
	public function create(): Component
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addGroup('webManager.web.hooks.bingApi.tag.title');
		$form->addInteger('tagId', 'webManager.web.hooks.bingApi.tag.tagId')
			->setDefaultValue($this->configurator->bingApi->tagId);

		$form->addGroup('webManager.web.hooks.bingApi.meta.title');
		$form->addText('meta', 'webManager.web.hooks.bingApi.meta.meta')
			->setDefaultValue($this->configurator->bingApi->meta);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'bingApiFormSucceeded'];

		return $form;
	}

	public function bingApiFormSucceeded(Form $form, ArrayHash $values): void
	{
		$config = $this->configurator->bingApi;

		$config->tagId = $values->tagId ?: null;
		$config->meta = $values->meta ?: null;

		$this->configurator->bingApi = $config;

		$this->flashNotifier->success('default.dataSaved');
	}
}