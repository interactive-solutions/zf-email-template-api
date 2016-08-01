<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

$formatDateTime = function (DateTime $dateTime = null) {
    return $dateTime ? $dateTime->format(DateTime::ISO8601) : null;
};

return [
    'id'               => $this->template->getId(),
    'uuid'             => $this->template->getUuid(),
    'locale'           => $this->template->getLocale(),
    'description'      => $this->template->getDescription(),
    'updateParameters' => $this->template->getUpdateParameters(),

    'subject'  => $this->template->getSubject(),
    'htmlBody' => $this->template->getHtmlBody(),
    'textBody' => $this->template->getTextBody(),

    'createdAt'           => $formatDateTime($this->template->getCreatedAt()),
    'updatedAt'           => $formatDateTime($this->template->getUpdatedAt()),
    'parametersUpdatedAt' => $formatDateTime($this->template->getParametersUpdatedAt())
];
