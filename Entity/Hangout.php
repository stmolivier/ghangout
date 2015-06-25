<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CPASimUSante\GhangoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;

/**
 * @ORM\Table(name="cpasimusante_hangout")
 * @ORM\Entity(repositoryClass="CPASimUSante\GhangoutBundle\Repository\HangoutRepository")
 */
class Hangout extends AbstractResource
{
    /**
     * @ORM\Column(name="hangout_url")
     */
    protected $url;

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Hangout
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
}
