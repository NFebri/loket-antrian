<?php

namespace App\Controllers;

use App\Models\Counter;
use App\Models\Queue;

class Home extends BaseController
{
    public function index()
    {
        $counter_model = model(Counter::class);
        $queue_model = model(Queue::class);

        $data = [];
        foreach ($counter_model->findAll() as $counter) {
            $queue = $queue_model->where('counter_id', $counter->id)
                ->where('date', date('Y-m-d'))
                ->first();

            $data[] = [
                'id' => $counter->id,
                'name' => $counter->name,
                'current_queue' => $queue->current_queue ?? '--'
            ];
        }

        return view('pages/home', compact('data'));
    }

    public function counterQueue()
    {
        $counter_model = model(Counter::class);
        $queue_model = model(Queue::class);

        $data = [];
        foreach ($counter_model->findAll() as $counter) {
            $queue = $queue_model->where('counter_id', $counter->id)
                ->where('date', date('Y-m-d'))
                ->first();

            $data[] = [
                'id' => $counter->id,
                'name' => $counter->name,
                'current_queue' => $queue->current_queue ?? '--'
            ];
        }

        return json_encode($data);
    }
}
