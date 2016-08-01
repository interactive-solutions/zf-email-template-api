<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailTemplateApi\Factory\Controller;

use Doctrine\ORM\EntityManager;
use InteractiveSolutions\EmailTemplateApi\Controller\EmailTemplateResourceController;
use Roave\EmailTemplates\Entity\TemplateEntity;
use Roave\EmailTemplates\Repository\TemplateRepository;
use Roave\EmailTemplates\Service\TemplateService;
use Zend\Mvc\Controller\ControllerManager;

final class EmailTemplateResourceControllerFactory
{
    public function __invoke(ControllerManager $manager): EmailTemplateResourceController
    {
        $serviceLocator = $manager->getServiceLocator();

        /* @var $repository TemplateRepository */
        $repository = $serviceLocator->get(TemplateRepository::class);

        /* @var $service TemplateService */
        $service = $serviceLocator->get(TemplateService::class);

        return new EmailTemplateResourceController($repository, $service);
    }
}
