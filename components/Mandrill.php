<?php
namespace app\components;

class Mandrill
{
    public $debug       = false;
    public $fromEmail   = '';
    public $fromName    = '';

    public function send($params = [])
    {
        try {
            $message = array_merge($params, [
                'from_email'    => $this->fromEmail,
                'from_name'     => $this->fromName,
            ]);
            return (new \Mandrill())->messages->send($message);
        } catch (Mandrill_Error $e) {
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            throw $e;
        }
    }
}