<?php
namespace Craft;

class Mandrill_AttachmentModel extends Mandrill_BaseModel
{
    protected function defineAttributes()
    {
        return [
            'name' => AttributeType::String,
            'type' => AttributeType::String,
            'content' => AttributeType::String,
        ];
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['name, type, content', 'required'];
        $rules[] = [implode(',', array_keys($this->getAttributes())), 'safe'];

        return $rules;
    }
}