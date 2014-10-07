<?php
namespace Sandstorm\GedmoTest\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Sandstorm.GedmoTest".   *
 *                                                                        *
 *                                                                        */

use Gedmo\Translatable\TranslatableListener;
use Sandstorm\GedmoTest\Domain\Model\ChosenLanguage;
use TYPO3\Flow\Annotations as Flow;
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
	 * @var ChosenLanguage
	 */
	protected $chosenLanguage;

	/**
	 * @Flow\Inject
	 * @var TranslatableListener
	 */
	protected $translatableListener;

	protected function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view) {
		$view->assign('currentLanguage', $this->chosenLanguage->getLanguage());
	}

	public function loadLanguage() {
		if ($this->chosenLanguage->getLanguage() !== '') {
			$this->translatableListener->setTranslatableLocale($this->chosenLanguage->getLanguage());
		}
	}

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->loadLanguage();
		$this->view->assign('events', $this->eventRepository->findAll());
	}

	/**
	 * @param string $language
	 */
	public function chooseLanguageAction($language) {
		$this->chosenLanguage->setLanguage($language);
		$this->redirect('index');
	}

	/**
	 * @param \Sandstorm\GedmoTest\Domain\Model\Event $event
	 * @return void
	 */
	public function showAction(Event $event) {
		$this->loadLanguage();
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