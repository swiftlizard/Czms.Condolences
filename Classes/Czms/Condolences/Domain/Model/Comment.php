<?php
namespace Czms\Condolences\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Czms.Condolences".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Comment {

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=100 })
     * @ORM\Column(length=80)
     */
    protected $headline;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=100 })
     * @ORM\Column(length=80)
     */
    protected $name;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=4000 })
     * @ORM\Column(length=4000)
     */
    protected $condolence;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @param string $condolence
     */
    public function setCondolence($condolence){
        $this->condolence = $condolence;
    }

    /**
     * @return string
     */
    public function getCondolence(){
        return $this->condolence;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date){
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param string $headline
     */
    public function setHeadline($headline){
        $this->headline = $headline;
    }

    /**
     * @return string
     */
    public function getHeadline(){
        return $this->headline;
    }
}
?>