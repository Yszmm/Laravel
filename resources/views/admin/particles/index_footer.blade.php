<footer id="gtco-footer" role="contentinfo" style="text-align:center;">
    by Wuzuoda <a href="#" target="_blank">闽ICP备17034294号</a>
    <span id="sitetime"></span>

</footer>
<script language=javascript>
    function siteTime(){
        window.setTimeout("siteTime()", 1000);
        var seconds = 1000;
        var minutes = seconds * 60;
        var hours = minutes * 60;
        var days = hours * 24;
        var years = days * 365;
        var today = new Date();
        var todayYear = today.getFullYear();
        var todayMonth = today.getMonth()+1;
        var todayDate = today.getDate();
        var todayHour = today.getHours();
        var todayMinute = today.getMinutes();
        var todaySecond = today.getSeconds();

        var t1 = Date.UTC(2017,12,28,00,00,00);
        var t2 = Date.UTC(todayYear,todayMonth,todayDate,todayHour,todayMinute,todaySecond);
        var diff = t2-t1;
        var diffYears = Math.floor(diff/years);
        var diffDays = Math.floor((diff/days)-diffYears*365);
        var diffHours = Math.floor((diff-(diffYears*365+diffDays)*days)/hours);
        var diffMinutes = Math.floor((diff-(diffYears*365+diffDays)*days-diffHours*hours)/minutes);
        var diffSeconds = Math.floor((diff-(diffYears*365+diffDays)*days-diffHours*hours-diffMinutes*minutes)/seconds);
        document.getElementById("sitetime").innerHTML=" <br />勉强运行"+diffYears+" 年 "+diffDays+" 天 "+diffHours+" 小时 "+diffMinutes+" 分钟 "+diffSeconds+" 秒";
    }
    siteTime();
</script>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="{{asset('adminlte/js/jquery.min.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{asset('adminlte/js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('adminlte/js/bootstrap.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('adminlte/js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar -->
<script src="{{asset('adminlte/js/jquery.stellar.min.js')}}"></script>
<!-- Main -->
<script src="{{asset('adminlte/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('adminlte/editor/ueditor.parse.js')}}"></script>
<script type="text/javascript" >
    $(function () {
        uParse('#content',{
            rootPath:'editor'
        });

    });
</script>
