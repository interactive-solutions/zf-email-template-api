Email template api
==================

This project provides a rest api for `Roave\EmailTemplates` so that you can implement it in what ever backoffice 
your site is currently using.


# Installation

Installation is supported via composer 

`composer require interactive-solutions/zf-email-template-api`

# Configuration

This package relies on `Zf-Common\Zfc-Rbac` to handle authorization of who can access the api, so to configure
this project you need to update your ZfcRbac configuration with the permissions found in [here](https://github.com/interactive-solutions/zf-email-template-api/blob/master/src/TemplatePermissions.php)

```php 
namespace InteractiveSolutions\EmailTemplateApi;

final class TemplatePermissions
{
    const LIST   = 'interactive-solutions:email-template:list';
    const VIEW   = 'interactive-solutions:email-template:view';
    const UPDATE = 'interactive-solutions:email-template:update';
}
```

# Endpoints

Collection: `/interactive-solutions/email-templates`

Resource: `/interactive-solutions/email-templates/:uuid`

### Api body
```json 
{
    "id": "<string id>",
    "uuid": "6886a31a-8b7f-4e43-b90a-a9897ba2e845",
    "locale": "en-US",
    "description": null,
    "updateParameters": false,
    "subject": "Subject has not yet been set",
    "htmlBody": "This is the default message for the template with id: widerlov:evaluation:assigned,locale: en-US",
    "textBody": "This is the default message for the template with id: widerlov:evaluation:assigned,locale: en-US",
    "createdAt": "2016-07-30T15:00:13+0200",
    "updatedAt": "2016-07-30T15:00:13+0200",
    "parametersUpdatedAt": null
}
```
