<?php

namespace Snnyk\Yandex;

class Request 
{
    const API_LIST_URL = 'https://pddimp.yandex.ru/api2/admin/email/list';

    const API_ADD_URL = 'https://pddimp.yandex.ru/api2/admin/email/add';

    const API_DEL_URL = 'https://pddimp.yandex.ru/api2/admin/email/del';

    const API_EDIT_URL = 'https://pddimp.yandex.ru/api2/admin/email/edit';

    // if you want to see php curl events set true
    const DEBUG = false;

    //uniqued domain key
    private $key;

    //domain name without www ( example : domain.com )
    private $domain;

    //page of results
    public $page = 1;

    //limit on per page
    public $on_page = 100;

    public $username = null;

    public $password = null;

    function __construct($config)
    {
        $this->key = $config['key'];
        $this->domain = $config['domain'];
    }

    function execute($params)
    {
        $curl = curl_init( $params['url'] );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //if debug actived
        if(self::DEBUG)
        {
            $debugfile = fopen(dirname(__FILE__).'/debug.txt', 'w');
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_STDERR,  $debugfile );
        }

        //set postfileds if exist
        if(!empty( $params['postFields'] ))
        {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS,  http_build_query ( $params['postFields'] ));
        }
        
        //set headers
        if(!empty( $params['headers'] ))
        {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $params['headers'] );
        }
        
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    protected function getList()
    {
        $params = [
                    'url'       => self::API_LIST_URL."?domain={$this->domain}&page={$this->page}&on_page={$this->on_page}",
                    'headers'   => ["PddToken: {$this->key}"]
        ];

        return json_decode( $this->execute($params) );
    }

    protected function addUser($vars)
    {
        $params = [
                    'url'       => self::API_ADD_URL,
                    'headers'   => ["PddToken: {$this->key}"],
                    'postFields'=> ['domain' => $this->domain , 'login' => $vars['username'] , 'password' => $vars['password']]
        ];

        return json_decode( $this->execute($params) );
    }

    protected function deleteUser($username)
    {
        $params = [
                    'url'       => self::API_DEL_URL,
                    'headers'   => ["PddToken: {$this->key}"],
                    'postFields'=> ['domain' => $this->domain , 'login' => $username ]
        ];

        return json_decode( $this->execute($params) );
    }

    protected function editUser($vars)
    {
        $params = [
                    'url'       => self::API_EDIT_URL,
                    'headers'   => ["PddToken: {$this->key}"],
                    'postFields'=> ['domain' => $this->domain , 'login' => $vars['username'] , 'password' => $vars['password']]
        ];

        return json_decode( $this->execute($params) );
    }
}