<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> 「如果有妹妹就好了.」</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="GetTemplates.co" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />
</head>
<body>

<div class="gtco-loader"></div>

<div id="page">
    <nav class="gtco-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 text-left">
                    <div id="gtco-logo"><a href="/">Yszm<span>.</span></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
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
                        <li class="has-dropdown">
                            <a href="/">首页</a>
                            <ul class="dropdown">
                                <?php foreach ($types as $type){?>
                                <li><a href="/article_list/<?=$type['id']?>"><?=$type['name']?></a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php foreach ($types as $type){?>
                        <li><a href="/article_list/<?=$type['id']?>"><?=$type['name']?></a></li>
                        <?php }?>


                    </ul>
                </div>
            </div>

        </div>
    </nav>