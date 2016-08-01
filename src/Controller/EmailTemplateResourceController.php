<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailTemplateApi\Controller;

use InteractiveSolutions\EmailTemplateApi\TemplatePermissions;
use Roave\EmailTemplates\Entity\TemplateEntity;
use Roave\EmailTemplates\InputFilter\TemplateInputFilter;
use Roave\EmailTemplates\Repository\TemplateRepository;
use Roave\EmailTemplates\Service\TemplateService;
use ZfrRest\Http\Exception\Client\ForbiddenException;
use ZfrRest\Http\Exception\Client\NotFoundException;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class EmailTemplateResourceController
 *
 * @method bool isGranted(string $permission, $context = null)
 */
final class EmailTemplateResourceController extends AbstractRestfulController
{
    /**
     * @var TemplateService
     */
    private $service;

    /**
     * @var TemplateRepository
     */
    private $repository;

    /**
     * EmailTemplateResourceController constructor.
     *
     * @param TemplateRepository $repository
     * @param TemplateService    $service
     */
    public function __construct(TemplateRepository $repository, TemplateService $service)
    {
        $this->service    = $service;
        $this->repository = $repository;
    }

    private function getTemplate(string $permission = null): TemplateEntity
    {
        $template = $this->repository->getByUuid($this->params('id'));
        if (!$template) {
            throw new NotFoundException();
        }

        if ($permission !== null && !$this->isGranted($permission, $template)) {
            throw new ForbiddenException();
        }

        return $template;
    }

    public function put(): ResourceViewModel
    {
        $template = $this->getTemplate(TemplatePermissions::UPDATE);
        $values = $this->validateIncomingData(TemplateInputFilter::class);

        // We don't handle the exception because we are validating twice, a bit stupid
        // but that's how I wrote the template service
        $this->service->update($values, $template);

        return new ResourceViewModel(
            ['template' => $template],
            ['template' => 'interactive-solutions/email-template/resource']
        );
    }

    public function get(): ResourceViewModel
    {
        return new ResourceViewModel(
            ['template' => $this->getTemplate(TemplatePermissions::VIEW)],
            ['template' => 'interactive-solutions/email-template/resource']
        );
    }
}
