<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Htpp\Requests;
use Session ;
use Cart;
use App\Models\ProvinceModel;
use App\Models\DistrictModel;
use App\Models\TownModel;
use App\Models\FeeShipModel;
session_start();
class DeliveryController extends Controller
{
    //Kiểm tra đăng nhập session
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền Admin!');
            return Redirect::to('admin')->send();
        }
    }
    //Kiểm tra đăng nhập Auth
    public function AuthLogin_Auth(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            Session::put('message','Vui lòng đăng nhập quyền admin!');
            return Redirect::to('login-auth')->send();
        }
    }
    //Kiểm tra quyền hạn
    public function check_position(){
        $admin_status = Session::get('admin_status');
        if($admin_status == 0){
            return true;
        }else{
            // $mesage = Session::put('message','swal("Thông báo!", "Bạn không đủ thẩm quyền để thực hiện chức năng này","info")');
            return false;
        }
    }
    public function check_position_2(){
        $admin_status = Session::get('admin_status');
        if($admin_status == 0 || $admin_status == 1){
            return true;
        }else{
            // $mesage = Session::put('message','swal("Thông báo!", "Bạn không đủ thẩm quyền để thực hiện chức năng này","info")');
            return false;
        }
    }
    //AJAX hoàn toàn
    //Hiển thị trang quản lí vận chuyển(not ajaxRequesr $request)
    public function manager_delivery(Request $request){ 
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $province = ProvinceModel::orderby('province_id','ASC')->get();
            // $district = DistrictModel::orderby('district_id','ASC')->get();
            // $town = TownModel::orderby('town_id','ASC')->get();
        
            return view('delivery.manager_delivery')
            ->with(compact('province'));
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị tên và các khu vực tỉnh thành,quận,huyện phường ,xã, thị trấn
    public function select_delivery(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $data = $request->all();

            if($data['action']){
                $output = '';
                if($data['action']=="province"){
                    $select_district = DistrictModel::where('province_id',$data['ma_id'])
                    ->orderby('district_id','ASC')->get();
                    $output.= '<option value="">---Chọn quận huyện---</option>';
                    foreach($select_district as $key => $sel_dis){
                        $output.= '<option value="'.$sel_dis->district_id.'">'.$sel_dis->district_name.'</option>';
                    }
                }else{
                    $select_town = TownModel::where('district_id',$data['ma_id'])
                    ->orderby('town_id','ASC')->get();
                    $output.= '<option value="">---Chọn xã phường---</option>';
                    foreach($select_town as $key => $sel_town){
                        $output.= '<option value="'.$sel_town->town_id.'">'.$sel_town->town_name.'</option>';
                    }
                }
            }
            echo $output;
        }else{
            return redirect()->back()->send();
        }
    }
    //Hiển thị thông tin đã có trong bảng ship hàng
    public function select_information_delivery(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $data = $request->all();

            // Tìm kiếm 
            //  $province_fee_ship =  FeeShipModel::where('province_id','LIKE','%'.$data['province'].'%')
            //  ->get();
            $output = '';
            if($data['action']){
                if($data['action']=="province"){
                    if($data['ma_id']!=null){
                        // $output .=FeeshipModel::orderby('feeship_id','DESC')
                        // ->where('province_id',$data['ma_id'])
                        // // // ->paginate(10);
                        // ->get();
                        $province_fee_ship = FeeshipModel::orderby('feeship_id','DESC')
                        ->where('province_id',$data['ma_id'])
                        // // ->paginate(10);
                        ->get();
                        // $output .= $province_fee_ship;
                        $output .= '
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">  
                                    <table class="tbl-function-infomation">
                                        <thread> 
                                            <tr>
                                                <th class="th-infomation-title" style="width:5%;">
                                                    <label class="">
                                                    STT
                                                    </label>
                                                </th>
                                                <th class="th-infomation-title">Tên thành phố</th>
                                                <th class="th-infomation-title">Tên quận huyện</th> 
                                                <th class="th-infomation-title">Tên xã phường</th>
                                                <th class="th-infomation-title">Phí ship</th>
                                            </tr>  
                                        </thread>
                                        <tbody>
                                        ';
                                        $i=1;
                                        foreach($province_fee_ship as $key => $fee){

                                        $output.='
                                            <tr>
                                                <td class="td-infomation-title">'.$i++.'</td>
                                                <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                            </tr>
                                            ';
                                        }
                                        //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                        //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                        // contenteditable cho phép sửa đối tượng trong table
                                        $output.='		
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <div class="product-paginate">
                                '.''.'  
                            </div>
                        </footer>
                        ';
                    }else{
                        $feeship = FeeshipModel::orderby('feeship_id','DESC')
                        // ->paginate(10);
                        ->get();
                        $i = (request()->input('page',1)-1)*50;
                        //Cho i là số thứ tự khi phân trang
                        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
                        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
                        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
                        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 ;

                        $output .= '
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">  
                                            <table class="tbl-function-infomation">
                                                <thread> 
                                                    <tr>
                                                        <th class="th-infomation-title" style="width:5%;">
                                                            <label class="">
                                                            STT
                                                            </label>
                                                        </th>
                                                        <th class="th-infomation-title">Tên thành phố</th>
                                                        <th class="th-infomation-title">Tên quận huyện</th> 
                                                        <th class="th-infomation-title">Tên xã phường</th>
                                                        <th class="th-infomation-title">Phí ship</th>
                                                    </tr>  
                                                </thread>
                                                <tbody>
                                                ';
                                                $i=1;
                                                foreach($feeship as $key => $fee){

                                                $output.='
                                                    <tr>
                                                        <td class="td-infomation-title">'.$i++.'</td>
                                                        <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                        <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                        <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                        <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                                    </tr>
                                                    ';
                                                }
                                                //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                                //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                                // contenteditable cho phép sửa đối tượng trong table
                                                $output.='		
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <footer class="panel-footer">
                                    <div class="product-paginate">
                                        '.''.'  
                                    </div>
                                </footer>
                                ';
                    }
                }elseif($data['action']=="district"){
                    if($data['ma_id']){
                        $district_fee_ship = FeeshipModel::orderby('feeship_id','DESC')
                        ->where('district_id',$data['ma_id'])
                        // // ->paginate(10);
                        ->get();
                        // $output .= $province_fee_ship;
                        $output .= '
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">  
                                    <table class="tbl-function-infomation">
                                        <thread> 
                                            <tr>
                                                <th class="th-infomation-title" style="width:5%;">
                                                    <label class="">
                                                    STT
                                                    </label>
                                                </th>
                                                <th class="th-infomation-title">Tên thành phố</th>
                                                <th class="th-infomation-title">Tên quận huyện</th> 
                                                <th class="th-infomation-title">Tên xã phường</th>
                                                <th class="th-infomation-title">Phí ship</th>
                                            </tr>  
                                        </thread>
                                        <tbody>
                                        ';
                                        $i=1;
                                        foreach($district_fee_ship as $key => $fee){

                                        $output.='
                                            <tr>
                                                <td class="td-infomation-title">'.$i++.'</td>
                                                <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                            </tr>
                                            ';
                                        }
                                        //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                        //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                        // contenteditable cho phép sửa đối tượng trong table
                                        $output.='		
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <div class="product-paginate">
                                '.''.'  
                            </div>
                        </footer>
                        ';
                    }else{
                        $feeship = FeeshipModel::orderby('feeship_id','DESC')
                        // ->paginate(10);
                        ->get();
                        $i = (request()->input('page',1)-1)*50;
                        //Cho i là số thứ tự khi phân trang
                        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
                        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
                        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
                        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 ;

                        $output .= '
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">  
                                            <table class="tbl-function-infomation">
                                                <thread> 
                                                    <tr>
                                                        <th class="th-infomation-title" style="width:5%;">
                                                            <label class="">
                                                            STT
                                                            </label>
                                                        </th>
                                                        <th class="th-infomation-title">Tên thành phố</th>
                                                        <th class="th-infomation-title">Tên quận huyện</th> 
                                                        <th class="th-infomation-title">Tên xã phường</th>
                                                        <th class="th-infomation-title">Phí ship</th>
                                                    </tr>  
                                                </thread>
                                                <tbody>
                                                ';
                                                $i=1;
                                                foreach($feeship as $key => $fee){

                                                $output.='
                                                    <tr>
                                                        <td class="td-infomation-title">'.$i++.'</td>
                                                        <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                        <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                        <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                        <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                                    </tr>
                                                    ';
                                                }
                                                //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                                //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                                // contenteditable cho phép sửa đối tượng trong table
                                                $output.='		
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <footer class="panel-footer">
                                    <div class="product-paginate">
                                        '.''.'  
                                    </div>
                                </footer>
                                ';
                    }
                }elseif($data['action']=="town"){
                    if($data['ma_id']){
                        $town_fee_ship = FeeshipModel::orderby('feeship_id','DESC')
                        ->where('town_id',$data['ma_id'])
                        // // ->paginate(10);
                        ->get();
                        // $output .= $province_fee_ship;
                        $output .= '
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">  
                                    <table class="tbl-function-infomation">
                                        <thread> 
                                            <tr>
                                                <th class="th-infomation-title" style="width:5%;">
                                                    <label class="">
                                                    STT
                                                    </label>
                                                </th>
                                                <th class="th-infomation-title">Tên thành phố</th>
                                                <th class="th-infomation-title">Tên quận huyện</th> 
                                                <th class="th-infomation-title">Tên xã phường</th>
                                                <th class="th-infomation-title">Phí ship</th>
                                            </tr>  
                                        </thread>
                                        <tbody>
                                        ';
                                        $i=1;
                                        foreach($town_fee_ship as $key => $fee){

                                        $output.='
                                            <tr>
                                                <td class="td-infomation-title">'.$i++.'</td>
                                                <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                            </tr>
                                            ';
                                        }
                                        //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                        //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                        // contenteditable cho phép sửa đối tượng trong table
                                        $output.='		
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <div class="product-paginate">
                                '.''.'  
                            </div>
                        </footer>
                        ';
                    }else{
                        $feeship = FeeshipModel::orderby('feeship_id','DESC')
                        // ->paginate(10);
                        ->get();
                        $i = (request()->input('page',1)-1)*50;
                        //Cho i là số thứ tự khi phân trang
                        //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
                        //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
                        //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
                        //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 ;

                        $output .= '
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">  
                                            <table class="tbl-function-infomation">
                                                <thread> 
                                                    <tr>
                                                        <th class="th-infomation-title" style="width:5%;">
                                                            <label class="">
                                                            STT
                                                            </label>
                                                        </th>
                                                        <th class="th-infomation-title">Tên thành phố</th>
                                                        <th class="th-infomation-title">Tên quận huyện</th> 
                                                        <th class="th-infomation-title">Tên xã phường</th>
                                                        <th class="th-infomation-title">Phí ship</th>
                                                    </tr>  
                                                </thread>
                                                <tbody>
                                                ';
                                                $i=1;
                                                foreach($feeship as $key => $fee){

                                                $output.='
                                                    <tr>
                                                        <td class="td-infomation-title">'.$i++.'</td>
                                                        <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                        <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                        <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                        <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                                    </tr>
                                                    ';
                                                }
                                                //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                                //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                                // contenteditable cho phép sửa đối tượng trong table
                                                $output.='		
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <footer class="panel-footer">
                                    <div class="product-paginate">
                                        '.''.'  
                                    </div>
                                </footer>
                                ';
                    }   
                }
            }else{
                $feeship = FeeshipModel::orderby('feeship_id','DESC')
                    // ->paginate(10);
                    ->get();
                    $i = (request()->input('page',1)-1)*50;
                    //Cho i là số thứ tự khi phân trang
                    //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
                    //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
                    //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
                    //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 ;

                    $output .= '
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">  
                                        <table class="tbl-function-infomation">
                                            <thread> 
                                                <tr>
                                                    <th class="th-infomation-title" style="width:5%;">
                                                        <label class="">
                                                        STT
                                                        </label>
                                                    </th>
                                                    <th class="th-infomation-title">Tên thành phố</th>
                                                    <th class="th-infomation-title">Tên quận huyện</th> 
                                                    <th class="th-infomation-title">Tên xã phường</th>
                                                    <th class="th-infomation-title">Phí ship</th>
                                                </tr>  
                                            </thread>
                                            <tbody>
                                            ';
                                            $i=1;
                                            foreach($feeship as $key => $fee){

                                            $output.='
                                                <tr>
                                                    <td class="td-infomation-title">'.$i++.'</td>
                                                    <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                                    <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                                    <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                                    <td contenteditable data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                                </tr>
                                                ';
                                            }
                                            //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                            //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                            // contenteditable cho phép sửa đối tượng trong table
                                            $output.='		
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <footer class="panel-footer">
                                <div class="product-paginate">
                                    '.''.'  
                                </div>
                            </footer>
                            ';
            }

            echo $output;
        }else{
            return redirect()->back()->send();
        }
    }
    //Thêm tiền ship theo khu vực
    public function insert_delivery(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $data = $request->all();
            
            $test_town = FeeshipModel::orderby('feeship_id','DESC')
                ->where('town_id',$data['town'])
                ->get();
            // echo $test_town;
            // foreach($test_town as $key => $tow){
                if(count($test_town)>0){
                    $feeship_model = FeeShipModel::where('town_id',$data['town'])->first();   
                    if($data['fee_ship'] == null){
                        $feeship_model->feeship_number = $feeship_model->feeship_number;
                        $feeship_model->save();
                    }else{
                        $feeship_model->feeship_number = $data['fee_ship'];
                        $feeship_model->save();
                    }     
                
                }else{
                    $fee_ship = new FeeShipModel();
                    $fee_ship->province_id = $data['province'];
                    $fee_ship->district_id = $data['district'];
                    $fee_ship->town_id = $data['town'];
                    $fee_ship->feeship_number = $data['fee_ship'];
                    if($fee_ship->feeship_number){
                        $fee_ship->save();//Lưu dữ liệu
                        return redirect()->back()->send();
                    }else{
                        $fee_ship->feeship_number = 10000;
                        $fee_ship->save();//Lưu dữ liệu
                        return redirect()->back()->send();
                    }    
                    // echo 'Không có dữ liệu';
                }
            // }
            
                
            //return redirect()->back(); 
        }else{
            return redirect()->back()->send();
    }
    }
    //Hiển thị thông tin feeship
    public function load_delivery(Request $request){
        // $this->AuthLogin();
        $this->AuthLogin_Auth();
        $check_position = $this->check_position();
        if($check_position == true){
            $feeship = FeeshipModel::orderby('feeship_id','DESC')
            // ->paginate(10);
            ->get();
            $i = (request()->input('page',1)-1)*10;
            //Cho i là số thứ tự khi phân trang
            //input('page',1): lấy số trang với giá trị khởi đầu là 1, nếu trống thì mặc định là 0
            //vì trang có 10 sản phẩm thì nhân cho 10, sau khi chuyển
            //Ví dụ số trang là 1, thì lấy số khởi đầu là (1-1)*10 -> là 0, vậy khởi đầu là 0 
            //số trang là 2, thì lấy số khởi đầu là (2-1)*10 -> là 0, vậy khởi đầu là 10 ;

            $output = '';
            $output .= '
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">  
                                <table class="tbl-function-infomation">
                                    <thread> 
                                        <tr>
                                            <th class="th-infomation-title" style="width:5%;">
                                                <label class="">
                                                STT
                                                </label>
                                            </th>
                                            <th class="th-infomation-title">Tên thành phố</th>
                                            <th class="th-infomation-title">Tên quận huyện</th> 
                                            <th class="th-infomation-title">Tên xã phường</th>
                                            <th class="th-infomation-title">Phí ship</th>
                                        </tr>  
                                    </thread>
                                    <tbody>
                                    ';
                                    $i=1;
                                    foreach($feeship as $key => $fee){

                                    $output.='
                                        <tr>
                                            <td class="td-infomation-title">'.$i++.'</td>
                                            <td class="td-infomation-title">'.$fee->province_model->province_name.'</td>
                                            <td class="td-infomation-title">'.$fee->district_model->district_name.'</td>
                                            <td class="td-infomation-title">'.$fee->town_model->town_name.'</td>
                                            <td data-fee_feeship_id="'.$fee->feeship_id.'" class="td-infomation-title feeship_edit">'.number_format($fee->feeship_number,0,',','.').'</td>
                                        </tr>
                                        ';
                                    }
                                    //data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình
                                    //province_model, district_model, town_model được lấy từ các function thuộc FeeShipModel
                                    // contenteditable cho phép sửa đối tượng trong table
                                    $output.='		
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="product-paginate">
                            '.''.'  
                        </div>
                    </footer>
                    ';
                    echo $output;
        }else{
            return redirect()->back()->send();
        }
    }
    // //Cập nhật giá feeship
    // public function update_delivery(Request $request){
    //     $data = $request->all();
    //     $feeship_model = FeeShipModel::find($data['fee_feeship_id']);
    //     //$fee_ship = FeeShipModel::where('feeship_id',$data['fee_feeship_id']);
    //     //Dùng find thay vì where vì find sẽ chủ động lấy cái id trong model và so sánh luôn
    //     //Nên trong trường hợp đối tượng là id thì ko cần dùng where vẫn được
    //     $feeship_nodot =rtrim($data['fee_value'],'.');
    //     //rtrim là hàm cắt bỏ khỏi chuỗi, ở đây là dấu chấm
    //     $feeship_model->feeship_number = $feeship_nodot;
    //     if($feeship_model->feeship_number){
    //         $feeship_model->save();//Lưu dữ liệu
    //     }else{
    //         $feeship_model->feeship_number = 10000;
    //         $feeship_model->save();//Lưu dữ liệu
    //     }
    // }
}
