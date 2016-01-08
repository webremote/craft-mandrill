# Craft CMS Mandrill plugin
Send mail using the Mandrill API from within another plugin

## Installing
* Update your composer file:

add url to your repositories (not on packagist just yet):

```repositories
{
    "type": "git",
    "url": "https://github.com/WHITEdevelopment/craft-mandrill"
}
```

add to require:

```
    "WHITEdevelopment/craft-mandrill": "~1"
```

* Browse to Settings > Plugins in the Craft CP
* Click on the Install button
* Enter API key 

## Usage

Call this plugin from within your plugin service:

```php
$messageModel = craft()->mandrill_message->newMessage();
$messageModel->setAttribute('subject', 'My subject');
$messageModel->setAttribute('body', '<html>body<html>');
$messageModel->setAttribute('from_name', 'user');
$messageModel->setAttribute('from_email', 'email@from.com');
$messageModel->setAttribute('to', [['name' => 'recipient', 'email' => 'email@recipient.com']]); // array with an array for every recipient
craft()->mandrill_message->send($messageModel);
```

## To do
* Display time in current Craft locale format
* Catch Mandrill exceptions and display in Craft  