<?php
namespace Craft;

class MandrillVariable
{

    public function message($id)
    {
        return craft()->mandrill_message->getMessageById($id);
    }

    public function messages()
    {
        return craft()->mandrill_message->getAllMessages();
    }
}
