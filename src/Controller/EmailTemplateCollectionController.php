<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailTemplateApi\Controller;

use Doctrine\Common\Collections\Criteria;
use DoctrineModule\Paginator\Adapter\Selectable;
use InteractiveSolutions\EmailTemplateApi\TemplatePermissions;
use Roave\EmailTemplates\Repository\TemplateRepositoryInterface;
use Zend\Http\Request;
use Zend\Paginator\Paginator;
use ZfrRest\Http\Exception\Client\ForbiddenException;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class EmailTemplateCollectionController
 *
 * @method bool isGranted(string $permission, $context = null)
 * @method Request getRequest
 */
final class EmailTemplateCollectionController extends AbstractRestfulController
{
    /**
     * @var TemplateRepositoryInterface
     */
    private $repository;

    /**
     * EmailTemplateCollectionController constructor.
     *
     * @param TemplateRepositoryInterface $repository
     */
    public function __construct(TemplateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(): ResourceViewModel
    {
        if (!$this->isGranted(TemplatePermissions::LIST)) {
            throw new ForbiddenException();
        }

        $criteria = Criteria::create();
        $this->injectSorting($criteria);

        $paginator = new Paginator(new Selectable($this->repository->matching($criteria)));
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage((int) $this->params()->fromQuery('limit', 20));

        return new ResourceViewModel(
            ['templates' => $paginator],
            ['template' => 'interactive-solutions/email-template/collection']
        );
    }

    public function injectSorting(Criteria $criteria) {
        $orderBy = [];
        $sort = $this->getRequest()->getQuery()->get('sorting');

        if ($sort) {

            $fields = explode(',', $sort);

            foreach ($fields as $field) {
                $parts = explode(':', $field);

                // Ignore it
                if (count($parts) != 2) continue;

                $orderBy[$parts[0]] = $parts[1];
            }
            $criteria->orderBy($orderBy);
        }
    }
}
