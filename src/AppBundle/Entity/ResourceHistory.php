<?php
// src/AppBundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResourceHistoryRepository")
 * @ORM\Table(name="resource_history")
 */
class ResourceHistory
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Resource")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $resource;

    /**
     * @ORM\Column(type="text")
     */
    private $html;

    /**
     * @ORM\Column(type="text")
     */
    private $oldHtml;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(name="alert_sent", type="boolean")
     */
    private $alertSent;

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
     * Set html
     *
     * @param string $html
     *
     * @return ResourceHistory
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ResourceHistory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set alertSent
     *
     * @param boolean $alertSent
     *
     * @return ResourceHistory
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
     * Set resource
     *
     * @param \AppBundle\Entity\Resource $resource
     *
     * @return ResourceHistory
     */
    public function setResource(\AppBundle\Entity\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \AppBundle\Entity\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set oldHtml
     *
     * @param string $oldHtml
     *
     * @return ResourceHistory
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
}
