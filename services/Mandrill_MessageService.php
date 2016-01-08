<?php
namespace Craft;

use Carbon\Carbon as Carbon;
use Mandrill as Mandrill;
use Mandrill_Error as Mandrill_Error;

class Mandrill_MessageService extends Mandrill_BaseService
{
    public function getAllMessages()
    {
        try {
            Carbon::setToStringFormat(self::PLUGIN_DATE_FORMAT);
            $date_from = Carbon::now()->subMonth()->toDateString();
            $date_to = Carbon::now()->toDateString();

            $mandrill = new Mandrill($this->getSetting('MandrillApiKey'));

            $result = $mandrill->messages->search('*', $date_from, $date_to);
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            // echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_ServiceUnavailable - Service Temporarily Unavailable
            throw $e;
        }

        return $result;
    }

    public function getMessageById($id)
    {
        try {
            $mandrill = new Mandrill($this->getSetting('MandrillApiKey'));
            $result = $mandrill->messages->info($id);
        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            // echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Message - No message exists with the id 'McyuzyCS5M3bubeGPP-XVA'
            throw $e;
        }

        return $result;
    }

    public function newMessage($attributes = [])
    {
        $messageModel = new Mandrill_MessageModel();
        $messageModel->setAttributes($attributes);

        return $messageModel;
    }

    public function send(Mandrill_MessageModel $messageModel)
    {
        if($this->getSetting('MandrillTestMode'))
        {
            $mandrill = new Mandrill($this->getSetting('MandrillApiTestKey'));
        }
        else
        {
            $mandrill = new Mandrill($this->getSetting('MandrillApiKey'));
        }

        try {
            $message = [
                'subject' => $messageModel->subject,
                'html' => $messageModel->html,
                'from_email' => $messageModel->from_email,
                'from_name' => $messageModel->from_name,
                'to' => $messageModel->to,
            ];

            if(!empty($messageModel->reply_to)) {
                $message['headers']['Reply-To'] = $messageModel->reply_to;
            }

            if (!empty($messageModel->attachments)) {
                /** @var Mandrill_AttachmentModel $attachmentModel */
                foreach($messageModel->attachments as $attachmentModel) {
                    $attachmentModel->validate();
                    if (!$attachmentModel->hasErrors()) {
                        $message["attachments"][] = [
                            'content' => $attachmentModel->content,
                            'type' => $attachmentModel->type,
                            'name' => $attachmentModel->name,
                        ];
                    }
                }
            }

            // add subaccount (if set)
            if($this->getSetting('MandrillSubAccount') != '')
            {
                $message['subaccount'] = $this->getSetting('MandrillSubAccount');
            }

            $result = $mandrill->messages->send($message);
        } catch(Mandrill_Error $e) {
            // echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'

            throw $e;
        }

        return $result;
    }
}