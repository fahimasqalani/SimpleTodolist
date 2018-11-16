<?php
namespace App\Http\Controllers;
use App\Entities\Task;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
class TaskController extends Controller
{
    public function getAdd()
    {
        return view('add');
    }
    public function postAdd(Request $request, EntityManagerInterface $em)
    {
        $task = new Task(
            $request->get('name'),
            $request->get('description')
        );
        $em->persist($task);
        $em->flush();
        return redirect('tasks')->with('success_message', 'Task added successfully!');
    }
    public function index(EntityManagerInterface $em)
    {
        $tasks = $em->getRepository(Task::class)->findAll();
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }
    public function getToggle(EntityManagerInterface $em, $taskId)
    {
        /* @var Task $task */
        $task = $em->getRepository(Task::class)->find($taskId);
        $task->toggleStatus();
        $newStatus = ($task->isDone()) ? 'done' : 'not done';
        $em->flush();
        return redirect('tasks/')->with('success_message', 'Task successfully marked as ' . $newStatus);
    }
    public function getDelete(EntityManagerInterface $em, $taskId)
    {
        $task = $em->getRepository(Task::class)->find($taskId);
        $em->remove($task);
        $em->flush();
        return redirect('/')->with('success_message', 'Task successfully removed.');
    }
    public function getEdit(EntityManagerInterface $em, $taskId)
    {
        $task = $em->getRepository(Task::class)->find($taskId);
        return view('edit', [
            'task' => $task
        ]);
    }
    public function postEdit(Request $request, EntityManagerInterface $em, $taskId)
    {
        /* @var Task $task */
        $task = $em->getRepository(Task::class)->find($taskId);
        $task->setName($request->get('name'));
        $task->setDescription($request->get('description'));
        $em->merge($task);
        $em->flush();
        return redirect('tasks')->with('success_message', 'Task modified successfully.');
    }
}