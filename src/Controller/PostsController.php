<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Posts->find()
            ->contain(['Users']);
        $posts = $this->paginate($query);

        $this->set(compact('posts'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, contain: ['Users', 'Sections']);
        $this->set(compact('post'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEmptyEntity();
        if ($this->request->is('post')) {
            
            $post = $this->Posts->patchEntity($post, $this->request->getData());
           
            //ログイン中ユーザーidを取得してuser_idを自動でセットする
            $user=$this->request->getAttribute('identity');
            $post->user_id=$user->id;


            if ($this->Posts->save($post)) {
                $this->Flash->success(__('投稿しました'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('投稿に失敗しました'));
        }
        $users = $this->Posts->Users->find('list', limit: 200)->all();
        $sections = $this->Posts->Sections->find('list', limit: 200)->all();
        $this->set(compact('post', 'users', 'sections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, contain: ['Sections']);

        // ログインユーザー取得
        $user = $this->request->getAttribute('identity');
        // ★ 他人の投稿なら拒否
        // if ($post->user_id !== $user->id) {
        //     throw new ForbiddenException('この投稿を編集する権限がありません');
        // }

        //これは次の条件を 両方満たした場合だけ エラーを出します。ログインユーザーが admin ではないその投稿の所有者でもない
        if ($user->role !== 'admin' && $post->user_id !== $user->id) {
            throw new ForbiddenException('この投稿を編集する権限がありません');
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('投稿が更新されました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('投稿が更新されませんでした。再度お試しください。'));
        }
        $users = $this->Posts->Users->find('list', limit: 200)->all();
        $sections = $this->Posts->Sections->find('list', limit: 200)->all();
        $this->set(compact('post', 'users', 'sections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);

        // ログインユーザー取得
        $user = $this->request->getAttribute('identity');

        // 他人の投稿なら拒否
        //if (!$user || $post->user_id !== $user->id) {
        //    throw new ForbiddenException('この投稿を削除する権限がありません');
        //}

         //これは次の条件を 両方満たした場合だけ エラーを出します。ログインユーザーが admin ではないその投稿の所有者でもない
        if ($user->role !== 'admin' && $post->user_id !== $user->id) {
            throw new ForbiddenException('この投稿を削除する権限がありません');
        }


        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('投稿は削除されました。'));
        } else {
            $this->Flash->error(__('投稿の削除に失敗しました。再度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    // sectionアクションの追加 
    public function section($id = null)
    {
        $section = $this->Posts->Sections->get($id, [
            'contain' => ['Posts' => ['Users']]
        ]);
        $this->set(compact('section'));
    }
}
