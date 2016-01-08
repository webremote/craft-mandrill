<?php
namespace Craft;

class Mandrill_MessageModel extends Mandrill_BaseModel
{
    protected function defineAttributes()
    {
        return [
            'subject' => AttributeType::String,
            'html' => AttributeType::String,
            'from_name' => AttributeType::String,
            'from_email' => AttributeType::Email,
            'to' => AttributeType::Mixed,
            'reply_to' => AttributeType::Email,
            'attachments' => AttributeType::Mixed,
        ];
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['subject, html, from_email, to', 'required'];
        $rules[] = [implode(',', array_keys($this->getAttributes())), 'safe'];

        return $rules;
    }
}