<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;

/**
 * Controller used to manage blog contents in the backend.
 *
 * Please note that the application backend is developed manually for learning
 * purposes. However, in your real Symfony application you should use any of the
 * existing bundles that let you generate ready-to-use backends without effort.
 * See http://knpbundles.com/keyword/admin
 *
 * @Route("/admin/samluser")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     * This controller responds to two different routes with the same URL:
     *   * 'admin_user_index' is the route with a name that follows the same
     *     structure as the rest of the controllers of this class.
     *   * 'admin_index' is a nice shortcut to the backend homepage. This allows
     *     to create simpler links in the templates. Moreover, in the future we
     *     could move this annotation to any other controller while maintaining
     *     the route name and therefore, without breaking any existing link.
     *
     * @Route("/", name="admin_samluser_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (null === $this->getUser() || !in_array('ROLE_ADMIN',$this->getUser()->getRoles())) {
            $this->addFlash('error', 'Users can only be viewed by administrators.');
            return $this->redirectToRoute('admin_index');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository('AppBundle:SAMLUser')->findAll();

        return $this->render('admin/samluser/index.html.twig', array('users' => $users));
    }


}
