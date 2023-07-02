<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\TasksModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;

class Tasks extends Controller
{
    public function index()
    {
        $model = new TaskModel();
        $data['tasks'] = $model->findAll();

        return view('tasks/index', $data);
    }

    public function getTasks()
    {
        $model = new TaskModel();
        $data['tasks'] = $model->findAll();

        $data = [];
        foreach ($data as $task) {
            $row = [];
            $row[] = $task['judul'];
            $row[] = $task['status'] == 1 ? 'Selesai' : 'Belum Selesai';
            $data[] = $row;
        }

        echo json_encode(['data' => $data]);
    }

    public function create()
    {
        $model = new TaskModel();

        $judul = $this->request->getPost('judul');
        $status = $this->request->getPost('status');

        $model->insert([
            'judul' => $judul,
            'status' => $status
        ]);

        return redirect()->to('/tasks');
    }

    public function edit($id)
    {
        $model = new TaskModel();
        $task = $model->find($id);

        if ($task === null) {
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        return view('tasks/edit', ['task' => $task]);
    }

    public function update($id)
    {
        $model = new TaskModel();
        $task = $model->findColumn($id);

        // Check if the task exists
        if ($task === null) {
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        // Get the updated task data from the form submission
        $updatedData = [
            'title' => $this->request->getPost('title'),
        ];

        // Check if the updated data is empty
        if (empty($updatedData)) {
            return redirect()->back()->with('error', 'No data provided for update');
        }

        // Update the task
        $model->update($id, $updatedData);

        return redirect()->to('/tasks')->with('success', 'Task updated successfully');
    }


    public function delete($id)
    {
        $model = new TaskModel();
        $task = $model->find($id);

        if ($task === null) {
            return redirect()->to('/tasks')->with('error', 'Task not found');
        }

        $model->delete($id);

        return redirect()->to('/tasks')->with('success', 'Task deleted successfully');
    }
}
