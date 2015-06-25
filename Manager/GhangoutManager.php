<?php
namespace CPASimUSante\GhangoutBundle\Manager;

use CPASimUSante\GhangoutBundle\Entity\Hangout;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormFactoryInterface;
use Claroline\CoreBundle\Persistence\ObjectManager;

/**
 * @DI\Service("cpasimusante.plugin.manager.ghangout")
 */
class GhangoutManager {
    private $em;

    /**
     * @DI\InjectParams({
     *      "em"                    = @DI\Inject("doctrine.orm.entity_manager"),
     *      "formFactory"           = @DI\Inject("form.factory"),
     *      "om"                    = @DI\Inject("claroline.persistence.object_manager")
     * })
     * @param EntityManager $em
     * @param FormFactoryInterface $formFactory
     * @param ObjectManager $om
     */
    public function __construct(
        EntityManager $em,
        FormFactoryInterface $formFactory,
        ObjectManager $om
    ) {
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->om = $om;
    }

    public function getResourceConfigByNode($node)
    {
        $resourceconfig = $this->em->getRepository("CPASimUSanteGhangoutBundle:Hangout")->findOneBy(
            array('resourceNode' => $node)
        );
        //no config set
        if (sizeof($resourceconfig) == 0)
        {
            return new Hangout();
        }
        else
        {
            return $resourceconfig;
        }
    }

}