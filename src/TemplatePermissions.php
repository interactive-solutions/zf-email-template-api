<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailTemplateApi;

final class TemplatePermissions
{
    const LIST   = 'interactive-solutions:email-template:list';
    const VIEW   = 'interactive-solutions:email-template:view';
    const UPDATE = 'interactive-solutions:email-template:update';
}
