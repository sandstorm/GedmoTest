<?php
namespace Sandstorm\GedmoTest\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Sandstorm.GedmoTest".   *
 *                                                                        *
 *                                                                        */

use Doctrine\Common\Persistence\ObjectManager;
use Gedmo\Translatable\Entity\Repository\TranslationRepository;
use Gedmo\Translatable\TranslatableListener;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cache\CacheManager;
use TYPO3\Flow\Mvc\Controller\ActionController;
use Sandstorm\GedmoTest\Domain\Model\Event;

class EventController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Sandstorm\GedmoTest\Domain\Repository\EventRepository
	 */
	protected $eventRepository;

	/**
	 * @Flow\Inject
	 * @var CacheManager
	 */
	protected $cacheManager;


	/**
	 * Doctrine's Entity Manager. Note that "ObjectManager" is the name of the related interface.
	 *
	 * @Flow\Inject
	 * @var ObjectManager
	 */
	protected $entityManager;

	/**
	 * @Flow\Inject
	 * @var TranslatableListener
	 */
	protected $translatableListener;

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->translatableListener->setTranslatableLocale('de');
		$this->view->assign('events', $this->eventRepository->findAll());
	}

	/**
	 * @param \Sandstorm\GedmoTest\Domain\Model\Event $event
	 * @return void
	 */
	public function showAction(Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * @param \Sandstorm\GedmoTest\Domain\Model\Event $newEvent
	 * @return void
	 */
	public function createAction(Event $newEvent) {
		$this->eventRepository->add($newEvent);
		$this->addFlashMessage('Created a new event.');
		$this->redirect('index');
	}

	/**
	 * @param \Sandstorm\GedmoTest\Domain\Model\Event $event
	 * @return void
	 */
	public function editAction(Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * @param \Sandstorm\GedmoTest\Domain\Model\Event $event
	 * @return void
	 */
	public function updateAction(Event $event) {


		/* @var $repository TranslationRepository */
		$repository = $this->entityManager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
		$repository->translate($event, 'name', 'de', 'Deutscher Titel');

		$this->eventRepository->update($event);
		$this->addFlashMessage('Updated the event.');
		$this->redirect('index');
	}

	/**
	 * @param \Sandstorm\GedmoTest\Domain\Model\Event $event
	 * @return void
	 */
	public function deleteAction(Event $event) {
		$this->eventRepository->remove($event);
		$this->addFlashMessage('Deleted a event.');
		$this->redirect('index');
	}

}