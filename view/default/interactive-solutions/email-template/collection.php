<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use Roave\EmailTemplates\Entity\TemplateEntity;
use Zend\Stdlib\ArrayUtils;

return [
    'data' => array_map(function (TemplateEntity $template) {
        return $this->renderResource('interactive-solutions/email-template/resource', ['template' => $template]);
    }, ArrayUtils::iteratorToArray($this->templates)),

    'meta' => $this->renderPaginator($this->templates),
];
