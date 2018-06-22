<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ArticleTypeController extends BaseController
{
    private $article_type_service;

    public function __construct()
    {
        parent::__construct();
        $this->article_type_service = getService('article_type_service');
    }

    public function index()
    {
        //display all article type
        $data = $this->article_type_service->getArticleTypeList();

        if (!empty($this->data)) {
            $data = array_merge($data, $this->data);
        }

        return view('article.type.show', $data);
    }

    public function create(Request $request)
    {
        $data = $this->article_type_service->processData($request);

        $result_process = $data['result_process']?? null;
//        dd($result_process, $data['message']?? []);

        if (!is_null($result_process)) {
            //check result return
            if ($result_process['result'] == true) {
                //disp flash succ msg
                $msg = array_except($result_process['message'], MESSAGE_TYPE_ERROR);
                $request->session()->flash('message', $msg);

                //go to list
                return redirect(route('article_list_type', [], false));
            } else {
                $data['message'] = $result_process['message']?? 'ERR';
            }
        }

        return view('article.type.create', $data);
    }
}
