<?php
namespace Czms\Condolences\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Czms.Condolences".       *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Class AdminCommandController
 *
 * @package Czms\Condolences\Command
 */
class AdminCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @var \TYPO3\Flow\Security\Policy\RoleRepository
	 * @Flow\Inject
	 */
	protected $roleRepository;

	/**
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;

	/**
	 * @var \TYPO3\Flow\Security\AccountFactory
	 * @Flow\Inject
	 */
	protected $accountFactory;


	/**
	 * Contoller Action to Setup all Data needed for package to work
	 *
	 * @return string
	 */
	public function setupCommand(){

		// Add Roles
		$this->addPolicyRole('Czms.Condolences:User');
		$this->addPolicyRole('Czms.Condolences:Admin');

		$this->roleRepository->persistEntities();

		$this->outputLine('Policy roles created');

	}

	/**
	 * @param string $username
	 * @param string $password
	 *
	 * @return string
	 */
	public function createAdminUserCommand($username, $password){
		$error = false;
		$defaultRole = 'Czms.Condolences:Admin';

		if($username == '' || strlen($username) < 3) {
			$this->outputLine('Username too short or empty');
			$error = true;
		}

		if($password == '' || strlen($password) < 6) {
			$this->outputLine('Password too short or does not match');
			$error = true;
		}

		if($error){
			exit;
		}

		// create a account with password an add it to the accountRepository
		$account = $this->accountFactory->createAccountWithPassword($username, $password, array($defaultRole));
		$this->accountRepository->add($account);

		// add a message and redirect to the login form
		$this->outputLine('Account created. Please login.');
	}

	/**
	 * @param string $identifier
	 * @return string
	 */
	protected function addPolicyRole($identifier){
		if($this->roleRepository->findByIdentifier($identifier) === Null){
			$user = new \TYPO3\Flow\Security\Policy\Role($identifier);
			$this->roleRepository->add($user);
			$this->outputLine('Policy role:' . $identifier .' added ');
		}else{
			$this->outputLine('Policy role:' . $identifier .' allready exists');
		}
	}

}