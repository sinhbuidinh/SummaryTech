<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;

class ArticleTypeController
{
    private $article_type_service;

    public function __construct()
    {
        $this->article_type_service = getService('article_type_service');
    }

    public function index()
    {
        //display all article type

        echo "index list";
        exit;
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
                $request->session()->flash('message', $result_process['message']['success']);

                //go to list
                return redirect(route('article_list_type', [], false));
            } else {
                $data['message'] = $result_process['message']?? 'ERR';
            }
        }

        return view('article.type.create', $data);
    }
}
