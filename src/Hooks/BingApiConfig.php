<?php

declare(strict_types=1);

namespace NAttreid\BingApi\Hooks;

use Nette\SmartObject;

/**
 * Class BingApiConfig
 *
 * @property int|null $tagId
 * @property string|null $meta
 *
 * @author Attreid <attreid@gmail.com>
 */
class BingApiConfig
{
	use SmartObject;

	/** @var int|null */
	private $tagId;

	/** @var string|null */
	private $meta;

	protected function getTagId(): ?int
	{
		return $this->tagId;
	}

	protected function setTagId(?int $tagId)
	{
		$this->tagId = $tagId;
	}

	protected function getMeta(): ?string
	{
		return $this->meta;
	}

	protected function setMeta(?string $meta)
	{
		$this->meta = $meta;
	}
}