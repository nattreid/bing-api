<?php

declare(strict_types=1);

namespace NAttreid\BingApi;

use NAttreid\BingApi\Hooks\BingApiConfig;
use Nette\Application\UI\Control;
use Nette\Utils\ArrayHash;

/**
 * Class BingApi
 *
 * @author Attreid <attreid@gmail.com>
 */
class BingApi extends Control
{
	/** @var BingApiConfig */
	private $config;

	/** @var ArrayHash[] */
	private $conversions = [];

	public function __construct(BingApiConfig $config)
	{
		parent::__construct();
		$this->config = $config;
	}

	/**
	 * @param float|null $value
	 * @param string $currency
	 * @return static
	 */
	public function conversion(float $value, string $currency): self
	{
		$obj = new ArrayHash;
		$obj->value = $value;
		$obj->currency = $currency;
		$this->conversions[] = $obj;

		return $this;
	}

	public function render(): void
	{
		$this->template->tagId = $this->config->tagId;
		$this->template->conversions = $this->conversions;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderHead(): void
	{
		$this->template->meta = $this->config->meta;
		$this->template->setFile(__DIR__ . '/templates/head.latte');
		$this->template->render();
	}
}

interface IBingApiFactory
{
	public function create(): BingApi;
}