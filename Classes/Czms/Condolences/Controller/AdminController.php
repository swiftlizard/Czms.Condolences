<?php
namespace Czms\Condolences\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * Class AdminController
 * @package Czms\Condolences\Controller
 */
class AdminController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @var \Czms\Condolences\Domain\Repository\CommentRepository
	 * @Flow\Inject
	 */
	protected $commentRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('comments', $this->commentRepository->findAll());
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