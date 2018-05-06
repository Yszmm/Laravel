@include("tool/tools")
@section("php")
<?php
//如果说是post请求，那么就执行添加操作。并且就结束。不再往下执行。
$db = conn();

$sql = "select * from qy_type";
$stmt = $db->prepare($sql);
$stmt->execute();
$types = $stmt->fetchAll();
?>
@endsection

@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">添加文章</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form action="/article/store" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>文章标题</label>
                        <input type="text" class="form-control" name="title" />
                    </div>
                    <div class="form-group">
                        <label>选择分类</label>
                        <select name="type" class="form-control">
                            <option>选择分类</option>
                            <?php foreach ($types as $type){?>
                            <option value="<?=$type['id']?>"><?=$type['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>文章内容</label>
                        <script id="container" name="content" type="text/plain"></script>                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="添加文章" />
                    </div>

                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>

    @endsection
@section('js')
    <script type="text/javascript" src="{{asset('adminlte/editor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('adminlte/editor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    @endsection