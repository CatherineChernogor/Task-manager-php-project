
<?php
namespace App\Controllers;

use App\Models\Order;

class AdminOrderController extends BaseController {

    public function index()
    {
        $orders = Order::get_all();

        $this->response()
            ->ajax(function($response) use ($orders)
            {
                $response->json(compact('orders'));
            })
            ->html(function($response) use ($orders)
            {
                $response->view('admin', compact('orders'));
            });
    }

    public function show()
    {
        $order = Order::get_by_id($this->request->get('id'));
        $this->response()->json(compact('order'));
    }

    public function update()
    {
        $order = Order::get_by_id($this->request->get('id'));

        $order->fill($this->request->post());

        if ($order->update())
        {
            $this->response()->flash_message('Заявка обновлена!');
        }
        else
        {
            $this->response()->status('422')->json(['errors' => $order->get_errors()]);
        }
    }

    public function delete()
    {
        $order = Order::get_by_id($this->request->get('id'));

        if ($order->delete())
        {
            $this->response()->flash_message('Заявка удалена!');
        }
    }

}