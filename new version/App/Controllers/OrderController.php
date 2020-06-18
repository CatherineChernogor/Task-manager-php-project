<?php

namespace App\Controllers;

use App\Models\Order;

class OrderController extends BaseController {

    public function show()
    {
        $order = new Order;
        return $this->response()->view('show', compact('order'));
    }

    public function save()
    {
        $order = new Order;
        $order->fill($this->request->post());

        if ($order->save())
        {
            $this->response()->flash_message('Заявка отправлена!');
        }
        else
        {
            $this->response()->status('422')
                ->ajax(function($response) use ($order)
                {
                    $response->json(['errors' => $order->get_errors()]);
                })
                ->html(function($response) use ($order)
                {
                    $response->view('show', compact('order'));
                });
        }
    }

}
