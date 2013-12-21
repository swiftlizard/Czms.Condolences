<?php
namespace Czms\Condolences\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Czms.Condolences".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class CommentController extends \TYPO3\Flow\Mvc\Controller\ActionController {

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
	}

    /**
     * @param \Czms\Condolences\Domain\Model\Comment $comment
     * @return void
     */
    public function createAction(\Czms\Condolences\Domain\Model\Comment $comment){
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