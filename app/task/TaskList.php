<?php
namespace App\Task;

class TaskList
{
    private array $tasks;

    public function add(Task $task): void {
        $this->tasks[] = $task;
    }
     public function get(int $index): ?Task {
         return $this->tasks[$index] ?? null;
     }

}