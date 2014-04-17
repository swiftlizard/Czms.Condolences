<?php
namespace Czms\Condolences\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Czms.Condolences".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Class StandardController
 * @package Czms\Condolences\Controller
 */
class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @var \TYPO3\Flow\Security\Policy\RoleRepository
	 * @Flow\Inject
	 */
	protected $roleRepo;

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('foos', array(
			'bar', 'baz'
		));
	}

	public function setupAction() {
		// Add Roles
		$user = new \TYPO3\Flow\Security\Policy\Role('Czms.Condolences:User');
		$this->roleRepo->add($user);
		$admin = new \TYPO3\Flow\Security\Policy\Role('Czms.Condolences:Admin');
		$this->roleRepo->add($admin);
		$this->persistenceManager->persistAll();
		$this->redirect('index', 'comment');
	}

}

?>