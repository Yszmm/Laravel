@if(empty(session('user.name')))
    <li >
        <a href="{{ url('redirectToProvider/qq') }}"><img src="{{ asset('adminlte\img\ogo_1.png') }}" alt="QQ登录" title="QQ登录"></a>
    </li>
@else
    <li>
        <span><img class="b-head_img" src="{{ session('user.avatar') }}" alt="{{ session('user.name') }}" title="{{ session('user.name') }}" width="50px" height="50px"/></span>
        <span class="b-nickname">{{ session('user.name') }}</span>
        <span><a href="{{ url('logout') }}">退出</a></span>
    </li>
@endif