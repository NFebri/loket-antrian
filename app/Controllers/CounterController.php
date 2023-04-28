<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Counter;
use App\Models\Queue;
use App\Models\UserModel;

class CounterController extends BaseController
{
    public function index()
    {
        $counters = model(Counter::class)->select(['counters.id', 'counters.name', 'users.username'])
            ->join('users', 'users.id = counters.user_id')
            ->findAll();

        return view('pages/counter/index', compact('counters'));
    }

    public function create()
    {
        return view('pages/counter/create', [
            'users' => model(UserModel::class)->findAll()
        ]);
    }

    public function store()
    {
        $counter_model = model(Counter::class);

        if (!$this->validate($counter_model->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $counter_model->save($this->request->getPost([
            'user_id', 'name'
        ]));

        return redirect()->route('counters_index')->with('message', 'Loket berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        return view('pages/counter/edit', [
            'counter' => model(Counter::class)->findOrFail($id),
            'users' => model(UserModel::class)->findAll()
        ]);
    }

    public function update(int $id)
    {
        $counter_model = model(Counter::class);
        $counter_model->findOrFail($id);

        if (!$this->validate($counter_model->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $counter_model->save($this->request->getPost([
            'id', 'user_id', 'name'
        ]));

        return redirect()->route('counters_index')->with('message', 'Loket berhasil diubah.');
    }

    public function destroy(int $id)
    {
        model(Counter::class)->delete($id);

        return redirect()->route('counters_index')->with('message', 'Loket berhasil dihapus');
    }

    public function queue()
    {
        $counter_model = model(Counter::class);
        $queue_model = model(Queue::class);

        $counter = $counter_model->where('user_id', user_id())->first();
        $queue = $queue_model->where('counter_id', $counter->id)
            ->where('date', date('Y-m-d'))
            ->first();

        return view('pages/counter/queue', compact('counter', 'queue'));
    }

    public function addQueue(int $id)
    {
        $queue_model = model(Queue::class);
        $counter = model(Counter::class)->findOrFail($id);

        $check_queue = $queue_model->where([
            'counter_id' => $counter->id, 'date' => date('Y-m-d')
        ])->first();

        if (!empty($check_queue)) {
            $queue_model->where([
                'counter_id' => $counter->id, 'date' => date('Y-m-d')
            ])->increment('total_queue', 1);
        } else {
            $queue_model->save([
                'counter_id' => $counter->id,
                'total_queue' => 1,
                'date' => date('Y-m-d')
            ]);
        }

        return redirect()->back();
    }

    public function nextQueue(int $id)
    {
        $queue_model = model(Queue::class);
        $counter = model(Counter::class)->findOrFail($id);

        $queue_model->where('counter_id', $counter->id)
            ->where('date', date('Y-m-d'))
            ->increment('current_queue');

        return redirect()->back();
    }
}
