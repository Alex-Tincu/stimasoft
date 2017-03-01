<?php
// src/AppBundle/Entity/Resource.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResourceRepository")
 * @ORM\Table(name="resource")
 */
class Resource
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $url;

    /**
     * @ORM\Column(name="css_rule", type="string", length=200)
     * @Assert\NotBlank()
     */
    private $cssRule;

    /**
     * @ORM\Column(name="last_html", type="text", nullable=true)
     */
    private $lastHtml = null;

    /**
     * @ORM\Column(name="check_date", type="datetime", nullable=true)
     */
    private $checkDate = null;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Resource
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set cssRule
     *
     * @param string $cssRule
     *
     * @return Resource
     */
    public function setCssRule($cssRule)
    {
        $this->cssRule = $cssRule;

        return $this;
    }

    /**
     * Get cssRule
     *
     * @return string
     */
    public function getCssRule()
    {
        return $this->cssRule;
    }

    /**
     * Set lastHtml
     *
     * @param string $lastHtml
     *
     * @return Resource
     */
    public function setLastHtml($lastHtml)
    {
        $this->lastHtml = $lastHtml;

        return $this;
    }

    /**
     * Get lastHtml
     *
     * @return string
     */
    public function getLastHtml()
    {
        return $this->lastHtml;
    }

    /**
     * Set checkDate
     *
     * @param \DateTime $checkDate
     *
     * @return Resource
     */
    public function setCheckDate($checkDate)
    {
        $this->checkDate = $checkDate;

        return $this;
    }

    /**
     * Get checkDate
     *
     * @return \DateTime
     */
    public function getCheckDate()
    {
        return $this->checkDate;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Resource
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
