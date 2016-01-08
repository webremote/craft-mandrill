<?php
namespace Craft;

class MandrillPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Mandrill');
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getDescription()
    {
        return 'Send mail using Mandrill API';
    }

    public function getDeveloper()
    {
        return 'WHITE';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.white.nl';
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/WHITEdevelopment/craft-mandrill';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/WHITEdevelopment/craft-mandrill/master/releases.json';
    }

    public function hasCpSection()
    {
        if($settings = $this->getSettings())
        {
            return $settings->MandrillShowCp;
        }
    }

    public function registerCpRoutes()
    {
        return [
            'mandrill\/message\/(?P<messageId>\w+)' => 'mandrill/message',
        ];
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('mandrill/settings', array(
            'settings' => $this->getSettings()
        ));
    }

    protected function defineSettings()
    {
        return array(
            'MandrillApiKey' => array(AttributeType::String),
            'MandrillApiTestKey' => array(AttributeType::String),
            'MandrillTestMode' => array(AttributeType::Bool),
            'MandrillSubAccount' => array(AttributeType::String),
            'MandrillShowCp' => array(AttributeType::Bool),
        );
    }

}
