<?php
namespace App\Task;

use InvalidArgumentException;

class TaskList
{
    /**
     * Task[] $_tasks
     */
    private array $tasks;

    public function add(Task $task): void
    {
        $this->tasks[] = $task;
    }

    public function get(int $index): ?Task
    {
        if ($index < 0) {
            throw new InvalidArgumentException ("The index cannot be negative");
        }
         return $this->tasks[$index] ?? null;
    }

    public function getById(int $id): ?Task
    {
        foreach ($this->tasks as $task) {
            if ($task->id === $id) {
                return $task;
            }
        }

        return null;
    }

    public function sortByName(): void
    {
        $this->sortBy("name");
    }

    public function sortById(): void
    {
        $this->sortBy("id");
    }

    public function sortBy(string $column): void
    {
        switch ($column){
        case "name":
            usort(
                $this->tasks,
                fn($task1, $task2) => strcmp($task1->name, $task2->name)
            );
            break;
        case "id":
            usort(
                $this->tasks,
                fn($task1, $task2) => $task1->id - $task2->id
            );
            break;
        default: 
            throw new InvalidArgumentException("The column does not exist");
        }
    }
}
