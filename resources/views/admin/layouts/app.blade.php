@yield("php")
@include("admin.particles.top")
@include("admin.particles.header")
@include("admin.particles.side")
    <div class="content-wrapper">
        @yield("content")
    </div>
@include("admin.particles.footer")