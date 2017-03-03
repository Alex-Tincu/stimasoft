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
     * @ORM\Column(name="new_html", type="text", nullable=true)
     */
    private $newHtml = null;

    /**
     * @ORM\Column(name="old_html", type="text", nullable=true)
     */
    private $oldHtml = null;

    /**
     * @ORM\Column(name="alert_html", type="text", nullable=true)
     */
    private $alertHtml = null;

    /**
     * @ORM\Column(name="alert_sent", type="boolean")
     */
    private $alertSent = 0;

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

    /**
     * Set newHtml
     *
     * @param string $newHtml
     *
     * @return Resource
     */
    public function setNewHtml($newHtml)
    {
        $this->newHtml = $newHtml;

        return $this;
    }

    /**
     * Get newHtml
     *
     * @return string
     */
    public function getNewHtml()
    {
        return $this->newHtml;
    }

    /**
     * Set oldHtml
     *
     * @param string $oldHtml
     *
     * @return Resource
     */
    public function setOldHtml($oldHtml)
    {
        $this->oldHtml = $oldHtml;

        return $this;
    }

    /**
     * Get oldHtml
     *
     * @return string
     */
    public function getOldHtml()
    {
        return $this->oldHtml;
    }

    /**
     * Set alertSent
     *
     * @param boolean $alertSent
     *
     * @return Resource
     */
    public function setAlertSent($alertSent)
    {
        $this->alertSent = $alertSent;

        return $this;
    }

    /**
     * Get alertSent
     *
     * @return boolean
     */
    public function getAlertSent()
    {
        return $this->alertSent;
    }

    /**
     * Set alertHtml
     *
     * @param string $alertHtml
     *
     * @return Resource
     */
    public function setAlertHtml($alertHtml)
    {
        $this->alertHtml = $alertHtml;

        return $this;
    }

    /**
     * Get alertHtml
     *
     * @return string
     */
    public function getAlertHtml()
    {
        return $this->alertHtml;
    }
}
