<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\CategoryModel;


class News extends BaseController
{
    public function index($layer = null)
    {
        $model = model(NewsModel::class);

        $data = [
            'news_list' => $model->getNews(),
            'title'     => 'News archive', // Siempre tiene que ser title
        ];
        if($layer == null) :
        return view('frontend/templates/header', $data)
            . view('frontend/news/index')
            . view('frontend/templates/footer');
        else : 
        return view('backend/templates/header', $data)
            . view('backend/news/index')
            . view('backend/templates/footer');
        endif;
    }


    public function show(?string $slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if ($data['news'] === null) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title']; //Siempre tiene que ser title

        return view('backend/templates/header', $data)
            . view('backend/news/view',$data)
            . view('backend/templates/footer');
    }
    public function new()
    {
        helper('form');
        $model_cat = model (CategoryModel::class);
        if($data['category'] = $model_cat->findAll()){
        return view('backend/templates/header', ['title' => 'Create a news item'])
            . view('backend/news/create',$data)
            . view('backend/templates/footer');
        }
    }
    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['title', 'body','id_category']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
            'id_category' => 'required',
            'img' => 'required'
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
            'id_category' => $post['id_category'],
            'img' => $post['img'],
        ]);

        // return view('templates/header', ['title' => 'Create a news item'])
        //     . view('news/success')
        //     . view('templates/footer');
            return redirect()->to(base_url('/news'));

    }
    public function delete($id)
{
    if ($id == null) {
        throw new PageNotFoundException('Cannot delete the item');
    }

    $model = model(NewsModel::class);
    if($model->where('id', $id)->find()){
        $model->where('id', $id)->delete();
    }else{
        throw new PageNotFoundException('Selected item does not exist in database');
    }

            return redirect()->to(base_url('/news'));
}

    public function update($id)
{
        helper('form');
        
        if ($id == null) {
            throw new PageNotFoundException('Cannot update the item');
        }
        
        $model = model(NewsModel::class);
        $categoryModel = model(CategoryModel::class);
        if($model->where('id',$id)->find()){
            $data = [
                'news' => $model->where('id',$id)->first(),
                'title' => 'Update item',
                'category' => $categoryModel->findAll(),
            ];
        } else {
            throw new PageNotFoundException('Selected item does not exist in database');
        }

        return view('backend/templates/header' , $data)
            . view('backend/news/update')
            . view('backend/templates/footer');
}


    public function updatedItem($id)
    {
        helper('form');
        
        $data_form = $this->request->getPost(['title', 'body', 'id_category']);

        $validationRules = [
            'title'       => 'required|max_length[255]|min_length[3]',
            'body'        => 'required|max_length[5000]|min_length[10]',
            'id_category' => 'required|integer|is_not_unique[category.id]',
            // 'img'         => 'required|max_length[5000]|ming_length[10]',
        ];

        if (! $this->validateData($data_form, $validationRules)) {
            return $this->update($id); 
        }

        $post = $this->validator->getValidated();
        $newsModel = model(NewsModel::class);

        $newsModel->save([
            'id'          => $id,
            'title'       => $post['title'],
            'slug'        => url_title($post['title'], '-', true),
            'body'        => $post['body'],
            'id_category' => $post['id_category'],
            // 'img'         => $post['img'],
        ]);
        
        session()->setFlashdata('message', 'La noticia ha sido actualizada exitosamente.');
        
        return redirect()->to(base_url('backend/'));
    }
}