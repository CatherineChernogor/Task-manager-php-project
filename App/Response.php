<?php

namespace App;

class Response {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function status($code)
    {
        header('status: ' . $code);
        header('HTTP/1.1 ' . $code);
        return $this;
    }

    public function ajax(Callable $callback)
    {
        if ($this->request->is_ajax())
        {
            $callback($this);
        }
        return $this;
    }

    public function html(Callable $callback)
    {
        if ( ! $this->request->is_ajax())
        {
            $callback($this);
        }
        return $this;
    }

    public function flash_message($message)
    {
        if ($this->request->is_ajax())
        {
            $this->json(['message' => $message]);
        }
        else
        {
            if ($message)
            {
                Flash::set($message);
            }

            $this->redirect($request->url());
        }
        return $this;
    }


    public function view($template, $data)
    {
        header('Content-Type: text/html; charset=utf-8');
        echo view($template, $data);
    }

    public function json($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }


}
