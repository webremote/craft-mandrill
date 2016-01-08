<?php
namespace Craft;

class Mandrill_BaseModel extends BaseElementModel
{
    protected function defineAttributes()
    {
        return [
            'dateCreated' => [
                'type' => AttributeType::DateTime,
                'required' => false,
            ],
            'dateUpdated' => [
                'type' => AttributeType::DateTime,
                'required' => false,
            ],
        ];
    }
}