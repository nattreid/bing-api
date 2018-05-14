<?php

declare(strict_types=1);

namespace NAttreid\BingApi\Hooks;

use Nette\SmartObject;

/**
 * Class BingApiConfig
 *
 * @property int $tagId
 *
 * @author Attreid <attreid@gmail.com>
 */
class BingApiConfig
{
	use SmartObject;

	/** @var int */
	private $tagId;

	protected function getTagId(): ?int
	{
		return $this->tagId;
	}

	protected function setTagId(?int $tagId)
	{
		$this->tagId = $tagId;
	}
}