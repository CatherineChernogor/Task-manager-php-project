<?php

namespace App;

class Request {

    protected $get_data = [];

    protected $post_data = [];

    protected $is_ajax = false;

    protected $url = '';

    protected $method = 'GET';

    public function __construct()
    {
        $this->url = getenv('REQUEST_URI');

        $this->method = getenv('REQUEST_METHOD');

        $this->get_data = $_GET;
        $this->post_data = $_POST;

        if (strpos(getenv('HTTP_CONTENT_TYPE'), 'application/json') !== false)
        {
            $this->post_data = json_decode(file_get_contents('php://input'), true);
        }

        $this->is_ajax = (getenv('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest');
    }

    public function get($variable = null, $default = null)
    {
        return $variable === null ? $this->get_data : array_get($this->get_data, $variable, $default);
    }

    public function post($variable = null, $default = null)
    {
        return $variable === null ? $this->post_data : array_get($this->post_data, $variable, $default);
    }

    public function url()
    {
        return $this->url;
    }

    public function method()
    {
        return $this->method;
    }

    public function is_ajax()
    {
        return $this->is_ajax;
    }

    public function create_response()
    {
        return new Response($this);
    }

}
