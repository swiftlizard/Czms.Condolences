<?php
namespace Czms\Condolences\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * Class AdminController
 * @package Czms\Condolences\Controller
 */
class AdminController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @var array
	 */
	protected $settings = array();

	/**
	 * @var \Czms\Condolences\Domain\Repository\CommentRepository
	 * @Flow\Inject
	 */
	protected $commentRepository;

	/**
	 * Injects the Flow settings, only the persistence part is kept for further use
	 *
	 * @param array $settings
	 * @return void
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
		// \TYPO3\Flow\var_dump($this->settings);
	}

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('comments', $this->commentRepository->findAll());
		$this->view->assign('settings', $this->settings);
	}

	/**
	 * @param \Czms\Condolences\Domain\Model\Comment $commentToDelete
	 */
	public function deleteAction(\Czms\Condolences\Domain\Model\Comment $commentToDelete) {
		$this->commentRepository->remove($commentToDelete);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Comment '.$commentToDelete->getHeadline().' by '.$commentToDelete->getName() .'deleted');
		$this->redirect('index');
	}
}
