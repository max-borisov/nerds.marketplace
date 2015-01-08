<?php

class PhpBBRegClass
{
    public function __construct()
    {
        global $user;

        // Registered users
        $this->group_id = 2;
        $this->timezone = '1';
        $this->language = 'en';
        //$this->user_type = USER_INACTIVE;
        $this->user_type = USER_NORMAL;
        // IP address of the user stored in the Database.
        $this->user_ip = $user->ip;
        // registration time of the user, timestamp format.
        $this->registration_time = time();

        /*$user_actkey = md5(rand(0, 100) . time());
        $user_actkey = substr($user_actkey, 0, rand(8, 12));*/
        //  Only for USER_INACTIVE
        //  'user_actkey'           => $user_actkey,

    }

    public function addUser()
    {
        $user_row = [
            'username'              => $this->username,
            'user_password'         => $this->password,
            'yii_password'          => $this->yii_password,
            'yii_confirmation_hash' => $this->yii_confirmation_hash,
            'user_email'            => $this->email,

            'group_id'              => $this->group_id,
            'user_timezone'         => $this->timezone,
            'user_lang'             => $this->language,
            'user_type'             => $this->user_type,
            'user_ip'               => $this->user_ip,
            'user_regdate'          => $this->registration_time,

            // 'user_inactive_reason'  => 0,
            // 'user_inactive_time'    => 0,
        ];
        return user_add($user_row);
    }
}