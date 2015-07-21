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
use TYPO3\Flow\Persistence\Generic\PersistenceManager;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;
use TYPO3\Flow\Property\PropertyMapper;
use TYPO3\Media\Domain\Repository\AssetRepository;

/**
 * @Flow\Entity
 */
class Event {
	use TranslatableTrait;

	/**
	 * @var array
	 * @Flow\Transient
	 */
	protected $translationAssociationMapping = array(
		'assetIdentifier' => 'asset'
	);

	/**
	 * @Gedmo\Translatable
	 * @var string
	 */
	protected $name;

	/**
	 * @Gedmo\Translatable
	 * @var string
	 */
	protected $assetIdentifier;

	/**
	 * @Flow\Inject
	 * @var AssetRepository
	 */
	protected $assetRepository;

	/**
	 * @Flow\Inject
	 * @var PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * @Flow\Inject
	 * @var PropertyMapper
	 */
	protected $propertyMapper;

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

	/**
	 * @return \TYPO3\Media\Domain\Model\Asset
	 */
	public function getAsset() {
		return $this->assetOnLoad($this->assetIdentifier);
	}

	/**
	 * @param array $asset
	 */
	public function setAsset($asset) {
		$this->assetIdentifier = $this->assetOnSave($asset);
	}

	/**
	 * @param array $asset
	 */
	public function assetOnSave($asset) {
		$asset = $this->propertyMapper->convert($asset, 'TYPO3\Media\Domain\Model\AssetInterface');
		if ($asset === NULL) {
			$this->assetRepository->remove($asset);
			return NULL;
		} elseif ($this->persistenceManager->isNewObject($asset)) {
			$this->assetRepository->add($asset);
			return $this->persistenceManager->getIdentifierByObject($asset);
		} else {
			$this->assetRepository->update($asset);
			return $this->persistenceManager->getIdentifierByObject($asset);
		}
	}

	public function assetOnLoad($assetIdentifier) {
		return $this->assetRepository->findByIdentifier($assetIdentifier);
	}
}