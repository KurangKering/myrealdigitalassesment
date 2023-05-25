<?php

declare(strict_types=1);

namespace App\Controller;

use Muffin\Trash\Model\Behavior\TrashBehavior;
use Cake\ORM\Entity;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tasks = [];
        try {
            $tasks = $this->paginate($this->Tasks, ['limit' => 10]);
        } catch (\Cake\Http\Exception\NotFoundException $ex) {
            return $this->redirect('/tasks/');
        } catch (\Throwable $th) {
        }
        $this->set(compact('tasks'));
    }

    /**
     * modalAdd method
     *
     * @return String html source
     */
    public function modalAdd()
    {
        $this->autoRender = false;

        $builder = $this->viewBuilder()
            ->setTemplatePath('Tasks')
            ->setTemplate('modalAdd')
            ->enableAutoLayout(false);
        $view = $builder->build();

        $html = $view->render();
        echo $html;
    }

    /**
     * modalView method
     *
     * @return String html source
     */
    public function modalView($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);

        $this->autoRender = false;
        $builder = $this->viewBuilder()
            ->setTemplatePath('Tasks')
            ->setTemplate('modalView')
            ->enableAutoLayout(false)
            ->setVars(compact('task'));
        $view = $builder->build();

        $html = $view->render();
        echo $html;
    }


    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('task'));
    }


    /**
     * Add method
     *
     * @return json 
     */
    public function add()
    {
        $task = $this->Tasks->newEmptyEntity();

        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());

            $success = false;
            $message = '';
            $output = [];

            if ($this->Tasks->save($task)) {
                $success = true;
                $message = 'Successfully added new task';
            } else {
                $success = false;
                $message = 'Failed when adding new task';
                $output = $this->MyComponent->setFormErrors($task->getErrors());
            }
            return $this->responseJson($success, $message, $output);
        }
    }

    /**
     * modalEdit method
     *
     * @return String html source
     */
    public function modalEdit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);

        $this->autoRender = false;
        $builder = $this->viewBuilder()
            ->setTemplatePath('Tasks')
            ->setTemplate('modalEdit')
            ->enableAutoLayout(false)
            ->setVars(compact('task'));
        $view = $builder->build();

        $html = $view->render();
        echo $html;
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return json
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            $success = false;
            $message = '';
            $output = [];

            if ($this->Tasks->save($task)) {
                $success = true;
                $message = 'Successfully update new task';
            } else {
                $success = false;
                $message = 'Failed when updating new task';
                $output = $this->MyComponent->setFormErrors($task->getErrors());
            }
            return $this->responseJson($success, $message, $output);
        }
    }

    /**
     * modalDelete method
     *
     * @return String html source
     */
    public function modalDelete($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);

        $this->autoRender = false;
        $builder = $this->viewBuilder()
            ->setTemplatePath('Tasks')
            ->setTemplate('modalDelete')
            ->enableAutoLayout(false)
            ->setVars(compact('task'));
        $view = $builder->build();
        $html = $view->render();
        echo $html;
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return json
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = null;
        try {
            $task = $this->Tasks->get($id);
            $task = $this->Tasks->patchEntity($task, ['status' => 'inactive']);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $output = [];
        if ($task == null) {
            $success = false;
            $message = 'No task found';
        } else if ($this->Tasks->delete($task)) {
            $success = true;
            $message = 'Successfully delete task';
        } else {
            $success = false;
            $message = 'Failed when delete task';
            $output = $this->MyComponent->setFormErrors($task->getErrors());
        }
        return $this->responseJson($success, $message, $output);
    }
}
