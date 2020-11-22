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
	 * @ORM\Column(nullable=true)
	 */
	protected $keyX;
	
	public function setKeyX($value)
	{
	    $this->keyX = $value; return $this;
	}
	
	public function getKeyX()
	{
	    return $this->keyX;
	}
	
	/**
	 * @ORM\Column(nullable=true)
	 */
	protected $keyY;
	
	public function setKeyY($value)
	{
	    $this->keyY = $value; return $this;
	}
	
	public function getKeyY()
	{
	    return $this->keyY;
	}
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $productId = 1;
	
	public function setProductId($value)
	{
	    $this->productId = $value; return $this;
	}
	
	public function getProductId()
	{
	    return $this->productId;
	}
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $x = 0;
	
	public function setX($value)
	{
	    $this->x = $value; return $this;
	}
	
	public function getX()
	{
	    return $this->x;
	}
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $y = 0;
	
	public function setY($value)
	{
	    $this->y = $value; return $this;
	}
	
	public function getY()
	{
	    return $this->y;
	}
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $z = 0;
	
	public function setZ($value)
	{
	    $this->z = $value; return $this;
	}
	
	public function getZ()
	{
	    return $this->z;
	}
	
	public function getVersion()
	{
	    return $this->x . '.' . $this->y . '.' . $this->z;
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
		return 'VINGC';
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

