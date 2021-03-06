@include('dashboard/header')
    <body>
        <nav class="navbar navbar-default navbar-top" role="navigation">
            <a class="navbar-brand" href="#">Link Shortener</a>
            <ul class="nav navbar-nav" id="navmenu">
                <li>
                    <a id="ajax-link" href="{{url('backend/page/link')}}">Create Link</a>
                </li>
                <li>
                    <a id="ajax-link" href="{{url('backend/page/history')}}">Link History</a>
                </li>
                <li>
                    <a href="{{url('logout')}}">Log Out</a>
                </li>
            </ul>
        </nav>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="result">
            @include('backend/link')
        </div>
    </body>
</html>