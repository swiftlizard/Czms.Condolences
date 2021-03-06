<?php
namespace Czms\Condolences\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Czms.Condolences".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Class CommentController
 * @package Czms\Condolences\Controller
 */
class CommentController extends \TYPO3\Flow\Mvc\Controller\ActionController {

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
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;


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
        $this->commentRepository->setDefaultOrderings(
            array(
                'date' =>  \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING
            )
        );
        $commentList = $this->commentRepository->findAll();
		$this->view->assign('commentList', $commentList);
		$this->view->assign('settings', $this->settings);
	}

	/**
	 * Adds the given new product object to the product repository
	 * @Flow\Validate(type="\Lelesys\Captcha\Validators\CaptchaValidator", value="$captcha")
	 * @Flow\Validate(type="NotEmpty", value="$captcha")
	 * @param \Czms\Condolences\Domain\Model\Comment $comment Comment to add
	 * @param string $captcha
	 * @return void
	 */
    public function createAction(\Czms\Condolences\Domain\Model\Comment $comment, $captcha){
        $comment->setDate(new \DateTime());
        $this->commentRepository->add($comment);
        $this->persistenceManager->persistAll();
        $this->redirect('index');
    }

    /**
     * @return void
     */
    public function thankYouAction(){
        // some code here
    }



}

?>
