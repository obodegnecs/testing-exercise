<?php
namespace App\Task;

use InvalidArgumentException;

class TaskList
{
    private array $tasks;

    public function add(Task $task): void {
        $this->tasks[] = $task;
    }

    public function get(int $index): ?Task {
        if ($index < 0) {
            throw new InvalidArgumentException;
        }
         return $this->tasks[$index] ?? null;
    }

    public function getById(int $id): ?Task {
        foreach ($this->tasks as $task) {
            if ($task->id === $id)
            return $task;
        }

        return null;
    }


}