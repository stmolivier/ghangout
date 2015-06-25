<?php

namespace CPASimUSante\GhangoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;

use Claroline\CoreBundle\Library\Resource\ResourceCollection;

use CPASimUSante\GhangoutBundle\Manager\GhangoutManager;

class GhangoutController extends Controller
{
    public $resourceManager;
    /**
     * @DI\InjectParams({
     *      "resourceManager"   = @DI\Inject("cpasimusante.plugin.manager.ghangout"),
     * })
     */
    public function __construct(
        GhangoutManager $resourceManager
    ){
        $this->resourceManager = $resourceManager;
    }

    /**
     * Listener controller method
     */

    /**
     * @EXT\Route("/open/{resourceId}", name="cpasimusante_ghangout_resource_open")
     * template to be displayed
     * @EXT\Template("CPASimUSanteGhangoutBundle:Hangout:resourceopen.html.twig")
     *
     * @param integer $resourceId id of resource
     * @return array parameters to send to the template
     */
    public function openAction($resourceId)
    {
        $em = $this->getDoctrine()->getManager();
        //retrieve the resource (object)
        $resource = $em->getRepository('CPASimUSanteGhangoutBundle:Hangout')->find($resourceId);

        //retrieve the user
        $user = $this->container->get('security.token_storage')
            ->getToken()->getUser();
        if (is_object($user)) {
            $uid = $user->getId();
        } else {
            $uid = 'anonymous';
        }

        //retrieve the WS
        $workspace = $resource->getResourceNode()->getWorkspace();

        $collection = new ResourceCollection(array($resource->getResourceNode()));
        //check the user authorization to edit
        $isGranted = $this->container->get('security.authorization_checker')->isGranted('EDIT', $collection);
        $node = $resource->getResourceNode();
        return array(
            'entity'        => $resource,
            'userId'        => $uid,
            'workspace'     => $workspace,
            '_resource'     => $resource,    //mandatory to keep the context and display for instance the breadcrumb in the template
            'isEditGranted' => $isGranted,
            'node'          => $node
        );
    }

    /**
     * Edit the resource
     * @EXT\Route(
     *     "/edit/{node}",
     *     name="cpasimusante_ghangout_edit_form",
     *     options={"expose"=true}
     * )
     *
     * @EXT\Template("CPASimUSanteGhangoutBundle:Hangout:edit.html.twig")
     *
     * @return array
     */
    public function edit(ResourceNode $node)
    {
        $resourceconfig = $this->resourceManager->getResourceConfigByNode($node->getId());

        $form = $this->getFactory()->create(
            new HangoutType(),
            $resourceconfig
        );

        return array(
            'form' => $form->createView(),
            'node' => $node
        );
    }
}
