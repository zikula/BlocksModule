<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.6.2 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Controller;

use ModUtil;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zikula\RoutesModule\Controller\Base\RouteController as BaseRouteController;
use SecurityUtil;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Zikula\RoutesModule\Entity\RouteEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Zikula\Core\Response\PlainResponse;

/**
 * Route controller class providing navigation and interaction functionality.
 */
class RouteController extends BaseRouteController
{
    /**
     * This method is the default function handling the admin area called without defining arguments.
     *
     * @Route("/%zikularoutesmodule.routing.route.plural%",
     *        name = "zikularoutesmodule_route_index",
     *        methods = {"GET"}
     * )
     *
     * @param Request  $request      Current request instance
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * This method provides a item list overview.
     *
     * @Route("/%zikularoutesmodule.routing.route.plural%/%zikularoutesmodule.routing.view.suffix%/{sort}/{sortdir}/{pos}/{num}.{_format}",
     *        name = "zikularoutesmodule_route_view",
     *        requirements = {"sortdir" = "asc|desc|ASC|DESC", "pos" = "\d+", "num" = "\d+", "_format" = "%zikularoutesmodule.routing.formats.view%"},
     *        defaults = {"sort" = "", "sortdir" = "asc", "pos" = 1, "num" = 0, "_format" = "html"},
     *        methods = {"GET"}
     * )
     *
     * @param Request  $request      Current request instance
     * @param string  $sort         Sorting field.
     * @param string  $sortdir      Sorting direction.
     * @param int     $pos          Current pager position.
     * @param int     $num          Amount of entries to display.
     * @param string  $tpl          Name of alternative template (to be used instead of the default template).
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function viewAction(Request $request, $sort, $sortdir, $pos, $num)
    {
        // Always force to see all entries to make sortable working.
        $request->query->set('all', 1);

        $groupMessages = array(
            RouteEntity::POSITION_FIXED_TOP => $this->__('Routes fixed to the top of the list:'),
            RouteEntity::POSITION_MIDDLE => $this->__('Normal routes:'),
            RouteEntity::POSITION_FIXED_BOTTOM => $this->__('Routes fixed to the bottom of the list:'),
        );
        $this->view->assign('groupMessages', $groupMessages);
        $this->view->assign('sortableGroups', array(RouteEntity::POSITION_MIDDLE));

        $configDumper = $this->get('zikula.dynamic_config_dumper');
        $configuration = $configDumper->getConfigurationForHtml('jms_i18n_routing');
        $this->view->assign('jms_i18n_routing', $configuration);

        return parent::viewAction($request, $sort, $sortdir, $pos, $num);
    }

    /**
     * This method provides a handling of edit requests.
     *
     * @Route("/%zikularoutesmodule.routing.route.singular%/edit/{id}.{_format}",
     *        name = "zikularoutesmodule_route_edit",
     *        requirements = {"id" = "\d+", "_format" = "html"},
     *        defaults = {"id" = "0", "_format" = "html"},
     *        methods = {"GET", "POST"}
     * )
     *
     * @param Request  $request      Current request instance
     * @param string  $tpl          Name of alternative template (to be used instead of the default template).
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     * @throws NotFoundHttpException Thrown by form handler if item to be edited isn't found
     */
    public function editAction(Request $request)
    {
        return parent::editAction($request);
    }

    /**
     * This method provides a item detail view.
     *
     * @Route("/%zikularoutesmodule.routing.route.singular%/{id}.{_format}",
     *        name = "zikularoutesmodule_route_display",
     *        requirements = {"id" = "\d+", "_format" = "%zikularoutesmodule.routing.formats.display%"},
     *        defaults = {"_format" = "html"},
     *        methods = {"GET"}
     * )
     *
     * @param Request  $request      Current request instance
     * @param RouteEntity $route      Treated route instance.
     * @param string  $tpl          Name of alternative template (to be used instead of the default template).
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     * @throws NotFoundHttpException Thrown by param converter if item to be displayed isn't found
     */
    public function displayAction(Request $request, RouteEntity $route)
    {
        return parent::displayAction($request, $route);
    }

    /**
     * This method provides a handling of simple delete requests.
     *
     * @Route("/%zikularoutesmodule.routing.route.singular%/delete/{id}.{_format}",
     *        name = "zikularoutesmodule_route_delete",
     *        requirements = {"id" = "\d+", "_format" = "html"},
     *        defaults = {"_format" = "html"},
     *        methods = {"GET", "POST"}
     * )
     *
     * @param Request  $request      Current request instance
     * @param RouteEntity $route      Treated route instance.
     * @param boolean $confirmation Confirm the deletion, else a confirmation page is displayed.
     * @param string  $tpl          Name of alternative template (to be used instead of the default template).
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     * @throws NotFoundHttpException Thrown by param converter if item to be deleted isn't found
     */
    public function deleteAction(Request $request, RouteEntity $route)
    {
        return parent::deleteAction($request, $route);
    }

    /**
     * This is a custom method.
     *
     * @Route("/%zikularoutesmodule.routing.route.plural%/reload",
     *        name = "zikularoutesmodule_route_reload",
     *        methods = {"GET", "POST"}
     * )
     *
     * @param Request  $request      Current request instance
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function reloadAction(Request $request)
    {
        $objectType = 'route';
        if (!SecurityUtil::checkPermission($this->name . ':' . ucwords($objectType) . ':', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        if ($request->isMethod('get') && !$request->query->filter('confirm', false, false, FILTER_VALIDATE_BOOLEAN)) {
            $legacyControllerType = 'admin';
            \System::queryStringSetVar('type', $legacyControllerType);
            $request->query->set('type', $legacyControllerType);

            $viewHelper = $this->serviceManager->get('zikularoutesmodule.view_helper');
            $templateFile = $viewHelper->getViewTemplate($this->view, $objectType, 'reload', $request);

            $this->view->setCacheId($objectType . '|reload');

            $kernel = $this->get('kernel');
            $modules = $kernel->getModules();
            $options = array(array(
                'text' => $this->__('All'),
                'value' => -1
            ));
            foreach ($modules as $module) {
                $options[] = array('text' => $module->getName(), 'value' => $module->getName());
            }
            $this->view->assign('options', $options);

            // fetch and return the appropriate template
            return $viewHelper->processTemplate($this->view, $objectType, 'reload', $request, $templateFile);
        }

        /** @var \Zikula\RoutesModule\Entity\Repository\Route $routeRepository */
        $routeRepository = $this->entityManager->getRepository('ZikulaRoutesModule:RouteEntity');
        $module = $this->request->request->get('reload-module', -1);
        if ($module == -1) {
            $routeRepository->reloadAllRoutes($this->getContainer());
            $request->getSession()->getFlashBag()->add('status', $this->__('Done! All routes reloaded.'));
            $hadRoutes = false;
        } else {
            $module = ModUtil::getModule($module);
            if ($module === null) {
                throw new NotFoundHttpException();
            }
            /** @var \Zikula\RoutesModule\Routing\RouteFinder $routeFinder */
            $routeFinder = $this->get('zikularoutesmodule.routing_finder');
            $routeCollection = $routeFinder->find($module);

            $hadRoutes = $routeRepository->removeAllOfModule($module);
            if ($routeCollection->count() > 0) {
                $routeRepository->addRouteCollection($module, $routeCollection);
            }
            $request->getSession()->getFlashBag()->add('status', $this->__f('Done! Routes reloaded for %s.', '<strong>' . $module->getName() . '</strong>'));
        }


        $cacheClearer = $this->get('zikula.cache_clearer');
        $cacheClearer->clear("symfony.routing");

        $this->view->clear_cache();

        $redirectUrl = $this->serviceManager->get('router')->generate('zikularoutesmodule_route_view', array('lct' => 'admin'));

        if ($hadRoutes) {
            // no need to pass through to nakedmessage if module previously had routes loaded.
            return new RedirectResponse(\System::normalizeUrl($redirectUrl));
        } else {
            $this->view->assign('delay', 2);
            $this->view->assign('url', $redirectUrl);
            $response = new PlainResponse($this->view->fetch('Admin/nakedmessage.tpl'));
            return $response;
        }
    }

    /**
     * This is a custom method.
     *
     * @Route("/%zikularoutesmodule.routing.route.plural%/renew",
     *        name = "zikularoutesmodule_route_renew",
     *        methods = {"GET"}
     * )
     *
     * @param Request  $request      Current request instance
     *
     * @return mixed Output.
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function renew(Request $request)
    {
        $objectType = 'route';
        if (!SecurityUtil::checkPermission($this->name . ':' . ucwords($objectType) . ':', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        // Renew the routing settings.
        ModUtil::apiFunc('ZikulaRoutesModule', 'admin', 'reloadMultilingualRoutingSettings');

        $request->getSession()->getFlashBag()->add('status', $this->__('Done! Routing settings renewed.'));
        $redirectUrl = $this->serviceManager->get('router')->generate('zikularoutesmodule_route_view', array('lct' => 'admin'));

        return new RedirectResponse(\System::normalizeUrl($redirectUrl));
    }

    /**
     * Process status changes for multiple items.
     *
     * This function processes the items selected in the admin view page.
     * Multiple items may have their state changed or be deleted.
     *
     * @Route("/%zikularoutesmodule.routing.route.plural%/handleSelectedEntries",
     *        name = "zikularoutesmodule_route_handleSelectedEntries",
     *        methods = {"POST"}
     * )
     *
     * @param string $action The action to be executed.
     * @param array  $items  Identifier list of the items to be processed.
     *
     * @return bool true on sucess, false on failure.
     *
     * @throws RuntimeException Thrown if executing the workflow action fails
     */
    public function handleSelectedEntriesAction(Request $request)
    {
        return parent::handleSelectedEntriesAction($request);
    }

    /**
     * This method cares for a redirect within an inline frame.
     *
     * @Route("/%zikularoutesmodule.routing.route.singular%/handleInlineRedirect/{idPrefix}/{commandName}/{id}",
     *        name = "zikularoutesmodule_route_handleInlineRedirect",
     *        requirements = {"id" = "\d+"},
     *        defaults = {"commandName" = "", "id" = 0},
     *        methods = {"GET"}
     * )
     *
     * @param string  $idPrefix    Prefix for inline window element identifier.
     * @param string  $commandName Name of action to be performed (create or edit).
     * @param integer $id          Id of created item (used for activating auto completion after closing the modal window).
     *
     * @return boolean Whether the inline redirect has been performed or not.
     */
    public function handleInlineRedirectAction($idPrefix, $commandName, $id = 0)
    {
        return parent::handleInlineRedirectAction($idPrefix, $commandName, $id);
    }
}
