<?php
namespace Sandstorm\GedmoTest\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Sandstorm.GedmoTest".   *
 *                                                                        *
 *                                                                        */

use Sandstorm\GedmoTranslatableConnector\TranslatableTrait;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Flow\Entity
 */
class Event {
	use TranslatableTrait;

	/**
	 * @Gedmo\Translatable
	 * @var string
	 */
	protected $name;

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}
}