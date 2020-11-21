<?php
namespace Kofus\Versioning\Entity;
use Doctrine\ORM\Mapping as ORM;
use Kofus\System\Node;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Table(name="kofus_versioning_commits", uniqueConstraints={@ORM\UniqueConstraint(name="hash", columns={"hash"})})
 * 
 */
class CommitEntity implements Node\NodeInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $id;
    
    public function getId()
    {
    	return $this->id;
    }
    
	/**
	 * @ORM\Column()
	 */
	protected $hash;
	
	public function setHash($value)
	{
		$this->hash = $value; return $this;
	}
	
	public function getHash()
	{
		return $this->hash;
	}
	
	/**
	 * @ORM\Column()
	 */
	protected $author;
	
	public function setAuthor($value)
	{
	    $this->author = $value; return $this;
	}
	
	public function getAuthor()
	{
	    return $this->author;
	}
	
	/**
	 * @ORM\Column(type="text")
	 */
	protected $message;
	
	public function setMessage($value)
	{
	    $this->message = $value; return $this;
	}
	
	public function getMessage()
	{
	    return $this->message;
	}
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $incrementX = false;
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $incrementY = false;
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $incrementZ = true;
	
	
	public function incrementX($value=true)
	{
	    $this->incrementX = $value; return $this;
	}
	
	public function incrementY($value=true)
	{
	    $this->incrementY = $value; return $this;
	}
	
	public function incrementZ($value=true)
	{
	    $this->incrementZ = $value; return $this;
	}
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $timestamp;
	
	public function setTimestamp(\DateTime $dt)
	{
	    $this->timestamp = $dt; return $this;
	}
	
	public function getTimestamp()
	{
	    return $this->timestamp;
	}
	
	
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $enabled = true;
	
	public function isEnabled($bool = null)
	{
		if ($bool !== null) {
		    $this->enabled = (bool) $bool;
		    return $this;
		}
		return $this->enabled;
	}
	
	public function getNodeType()
	{
		return 'VERC';
	}
	
	public function __toString()
	{
		return $this->getNodeId();
	}
	
	public function getNodeId()
	{
		return $this->getNodeType() . $this->getId();
	}
	
	
}

