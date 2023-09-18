<?php
namespace App\Task;

class TaskList
{
    private Task $task;

    public function add(Task $task): void {
     $this->task = $task;
    }
     public function get(int $index): ?Task {
         return $this->task ?? null;
     }

}