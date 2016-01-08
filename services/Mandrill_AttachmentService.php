<?php
namespace Craft;

class Mandrill_AttachmentService extends Mandrill_BaseService
{
    /**
     * @param array $attributes
     * @return Mandrill_AttachmentModel
     */
    public function newAttachment($attributes = [])
    {
        $attachmentModel = new Mandrill_AttachmentModel();
        $attachmentModel->setAttributes($attributes);

        return $attachmentModel;
    }
}