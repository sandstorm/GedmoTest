<?php
namespace Sandstorm\GedmoTest\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Sandstorm.GedmoTest".   *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("session")
 */
class ChosenLanguage {

	/**
	 * @var string
	 */
	protected $language;

	/**
	 * @param $language
	 * @Flow\Session(autoStart = TRUE)
	 */
	public function setLanguage($language) {
		$this->language = $language;
	}

	public function getLanguage() {
		return $this->language;
	}
} 