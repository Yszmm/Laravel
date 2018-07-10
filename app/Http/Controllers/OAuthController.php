<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\OauthUser;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
class OAuthController extends Controller
{
    //
    public function redirectToProvider(Request $request, $service)
    {
        // 记录登录前的url
        $data = [
            'targetUrl' => URL::previous()
        ];
        session($data);
        return Socialite::driver($service)->redirect();
    }
    public function handleProviderCallback (Request $request,OauthUser $oauthUserModel,$service)
    {
        $type =[
            'qq'=>1,
            'weibo'=>2,
            'github'=>3,
        ];
        //获取用户资料
       $user = Socialite::driver('qq')->user();

        $sessionData = [
            'user'=>[
                'name'=>$user->nickname,
                'type'=>$type[$service],
            ]
        ];
        //查找用户是否已经登陆过
        $countMap = [
            'type' => $type[$service],
            'openid' => $user->id
        ];
        $olduserdata = DB::table('oauth_users')->select('id','login_times','is_admin','email')
            ->where($countMap)
            ->first();
        // 如果已经存在;则更新用户资料  如果不存在;则插入数据
        if ($olduserdata) {
            $userId = $olduserdata->id;

            $editData = DB::table('oauth_users')
                ->where('id', $userId)
                ->update([
                'name' => $user->nickname,
                'access_token' => $user->token,
                'last_login_ip' => $request->getClientIp(),
                'login_times' => $olduserdata->login_times+1,
            ]);

            // 更新数据
            // 组合session中要用到的数据
            $sessionData['user']['id'] = $userId;
            $sessionData['user']['email'] = $olduserdata->email;
            $sessionData['user']['is_admin'] = $olduserdata->is_admin;
        } else {

//            $data = DB::table('oauth_users')->insert( [
//                'type' => $type[$service],
//                'name' => $user->nickname,
//                'openid' => $user->id,
//                'access_token' => $user->token,
//                'last_login_ip' => $request->getClientIp(),
//                'login_times' => 1,
//                'is_admin' => 0,
//                'email' => ''
//            ]);

            $data = OauthUser::create([
                'name' => $user->nickname,
                'openid' => $user->id,
                'access_token' => $user->token,
                'last_login_ip' => $request->getClientIp(),
                'login_times' => 1,
            ]);
            $data ->save();
            // 新增数据
            $userId =$data->id;
            // 组合头像地址
            $avatarPath = '/uploads/avatar/'.$userId.'.jpg';
            // 更新头像

            $editData =DB::table('oauth_users')
                ->where('id', $userId)
                ->update([
                'avatar' => $avatarPath
            ]);
            // 组合session中要用到的数据

            $sessionData['user']['id'] = $userId;
            $sessionData['user']['email'] = '';
            $sessionData['user']['is_admin'] = 0;
        }

        $avatarPath = public_path('uploads/avatar/'.$userId.'.jpg');
        try {
            // 下载最新的头像到本地
            $client = new Client();
            $client->request('GET', $user->avatar, [
                'sink' => $avatarPath
            ]);
        } catch (ClientException $e) {
            // 如果下载失败；则使用默认图片
            copy(public_path('uploads/avatar/default.jpg'), $avatarPath);
        }

        $sessionData['user']['avatar'] = url('uploads/avatar/'.$userId.'.jpg');
        // 将数据存入session
        session($sessionData);
        // 如果session没有存储登录前的页面;则直接返回到首页
       return redirect(session('targetUrl', url('/welcome')));

    }
    public function logout()
    {
        Auth::logout();
        session()->forget('user');
        return redirect()->back();
    }
}
