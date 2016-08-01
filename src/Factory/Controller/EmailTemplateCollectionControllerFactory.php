<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailTemplateApi\Factory\Controller;

use Doctrine\ORM\EntityManager;
use InteractiveSolutions\EmailTemplateApi\Controller\EmailTemplateCollectionController;
use Roave\EmailTemplates\Entity\TemplateEntity;
use Roave\EmailTemplates\Repository\TemplateRepository;
use Zend\Mvc\Controller\ControllerManager;

final class EmailTemplateCollectionControllerFactory
{
    public function __invoke(ControllerManager $manager): EmailTemplateCollectionController
    {
        $serviceLocator = $manager->getServiceLocator();

        $repository = $serviceLocator->get(TemplateRepository::class);

        return new EmailTemplateCollectionController($repository);
    }
}
