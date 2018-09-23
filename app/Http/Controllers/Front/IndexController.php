<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    public function front(Request $request)
    {
        $data = $request->all();
        $data['id'] = 1;
        $data['title'] = 'Dấu hiệu nhận biết';
        $data['type'] = 1;
        $data['content_left'] = '<li>
                        <span class="bold_txt">Giai đoạn 1:</span>
                        <br>
                        <span>+ Biểu hiện đỏ rát.</span>
                        <br>
                        <span>+ Mụn bọc, mụn nước.</span>
                        <br>
                        <span>+ Lở loét ở nhiều vị trí khác nhau.</span>
                        <br>
                        <span>biểu hiện của việc bị mưng mủ, chảy nước, xuất hiện các vết bỏng, đỏ, nổi mụn li ti…. </span>
                    </li>
                    <li>
                        <span class="bold_txt">Giai đoạn 2(giai đoạn bội nhiễm - HẬU ZONA - ZONA CẮN CHÌM):</span>
                        <br>
                        <span>Không biểu hiện mưng mủ hay nổi hột ngoài da nữa hoặc vẫn còn ít.</span>
                        <br>
                        <span>Nhưng kèm theo các biểu hiện như:</span>
                        <br>
                        <span>+ Đau rát dưới da.</span>
                        <br>
                        <span>+ Biểu hiện giống bị cắn trong da, thịt, bỏng rát trong cơ thể.</span>
                        <br>
                    </li>';
        $data['content_right'] = '<img src="img/sign.jpg" />
                    <span><b class="none">Ví dụ:</b> Mắt, phổi, gần tim, quanh vùng ngực, vùng bụng, sau lung ….. </span>
                    <span><strong class="none">Chú ý:</strong> Chụp XQuang thì người bệnh cũng không được xác định bị mắc bệnh gì.</span>';

        return view('front.index', $data);
    }
}
