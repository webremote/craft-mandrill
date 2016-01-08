<?php
namespace Craft;

class Mandrill_BaseService extends BaseApplicationComponent
{
    const PLUGIN_NAME = 'mandrill';
    const PLUGIN_DATE_FORMAT = 'm/d/Y';

    protected function getSettings()
    {
        return craft()->plugins->getPlugin(self::PLUGIN_NAME)->getSettings();
    }

    protected function getSetting($key)
    {
        $settings = $this->getSettings();
        return $settings->$key;
    }
}