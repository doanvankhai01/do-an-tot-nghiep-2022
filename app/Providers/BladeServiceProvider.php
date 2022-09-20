<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminModel;
class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole',function($expression){
            //hasrole là 1 cái tên
            //$expression là tên quyền được truyền tới
            if(Auth::user()){// user() là fix cứng, không thể thay đổi. Nếu người dùng có đăng nhập
                // 1 quyền
                if(Auth::user()->hasRoles($expression)){//kiểm tra người đăng nhập có quyền gì
                    return true;
                }
                // nhiều quyền
                if(Auth::user()->hasAnyRoles($expression)){//kiểm tra người đăng nhập có những quyền gì
                    return true;
                }
            }
            return false;
            
        });
    }
}
