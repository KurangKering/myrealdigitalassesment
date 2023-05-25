<?php

declare(strict_types=1);

namespace App\Controller;

use Muffin\Trash\Model\Behavior\TrashBehavior;
use Cake\ORM\Entity;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $users = [];
        try {
            $users = $this->paginate($this->Users, ['limit' => 10]);
        } catch (\Cake\Http\Exception\NotFoundException $ex) {
            return $this->redirect('/users/');
        } catch (\Throwable $th) {
        }
        $this->set(compact('users'));
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
            ->setTemplatePath('Users')
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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->autoRender = false;
        $builder = $this->viewBuilder()
            ->setTemplatePath('Users')
            ->setTemplate('modalView')
            ->enableAutoLayout(false)
            ->setVars(compact('user'));
        $view = $builder->build();

        $html = $view->render();
        echo $html;
    }

    /**
     * Add method
     *
     * @return json 
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $success = false;
            $message = '';
            $output = [];

            if ($this->Users->save($user)) {
                $success = true;
                $message = 'Successfully added new user';
            } else {
                $success = false;
                $message = 'Failed when adding new user';
                $output = $this->MyComponent->setFormErrors($user->getErrors());
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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->autoRender = false;
        $builder = $this->viewBuilder()
            ->setTemplatePath('Users')
            ->setTemplate('modalEdit')
            ->enableAutoLayout(false)
            ->setVars(compact('user'));
        $view = $builder->build();

        $html = $view->render();
        echo $html;
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return json
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $success = false;
            $message = '';
            $output = [];

            if ($this->Users->save($user)) {
                $success = true;
                $message = 'Successfully update new user';
            } else {
                $success = false;
                $message = 'Failed when updating new user';
                $output = $this->MyComponent->setFormErrors($user->getErrors());
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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->autoRender = false;
        $builder = $this->viewBuilder()
            ->setTemplatePath('Users')
            ->setTemplate('modalDelete')
            ->enableAutoLayout(false)
            ->setVars(compact('user'));
        $view = $builder->build();
        $html = $view->render();
        echo $html;
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return json
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = null;
        try {
            $user = $this->Users->get($id);
            $user = $this->Users->patchEntity($user, ['status' => 'inactive']);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $output = [];
        if ($user == null) {
            $success = false;
            $message = 'No user found';
        } else if ($this->Users->delete($user)) {
            $success = true;
            $message = 'Successfully delete user';
        } else {
            $success = false;
            $message = 'Failed when delete user';
            $output = $this->MyComponent->setFormErrors($user->getErrors());
        }
        return $this->responseJson($success, $message, $output);
    }
}
