<?php
namespace Kofus\Versioning\Entity;
use Doctrine\ORM\Mapping as ORM;
use Kofus\System\Node;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Table(name="kofus_versioning_releases", uniqueConstraints={@ORM\UniqueConstraint(name="u", columns={"token", "releaseType"})})
 * 
 */
class ReleaseEntity implements Node\NodeInterface
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
	 * @ORM\Column(nullable=true)
	 */
	protected $title;
	
	public function setTitle($value)
	{
		$this->title = $value; return $this;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @ORM\Column()
	 */
	protected $token;
	
	public function setToken($value)
	{
	    $this->token = $value; return $this;
	}
	
	public function getToken()
	{
	    return $this->token;
	}
	
	/**
	 * @ORM\Column(length=1)
	 */
	protected $releaseType;
	
	public static $RELEASE_TYPES = array(
	    'X' => 'Major',
	    'Y' => 'Minor',
	    'Z' => 'Patch'
	);
	
	public function setReleaseType($value)
	{
	    $this->releaseType = $value; return $this;
	}
	
	public function getReleaseType()
	{
	    return $this->releaseType;
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
	
	public function getNodeType()
	{
		return 'VINGR';
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

