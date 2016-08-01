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
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;
use ZfrRest\Http\Exception\Client\ForbiddenException;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class EmailTemplateCollectionController
 *
 * @method bool isGranted(string $permission, $context = null)
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

        $paginator = new Paginator(new Selectable($this->repository->matching($criteria)));
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage((int) $this->params()->fromQuery('limit', 20));

        return new ResourceViewModel(
            ['templates' => $paginator],
            ['template' => 'interactive-solutions/email-template/collection']
        );
    }
}
