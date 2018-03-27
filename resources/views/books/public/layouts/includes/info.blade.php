<style>
    .info{
        color: white;
    }
    .info li {
        list-style-type: none;
        margin-left: 10px;
    }
    .info p {
        padding: 0px;
    }
</style>

<div id="alert_box">
    <div class="col s12 m12 center-align">
        @if (count($errors) > 0)
            <div class="card red darken-1">
                <div class="row">
                    <div class="col s12 m12 info">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="card green darken-1">
                <div class="row">
                    <div class="col s12 m12 info">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if (Session::has('fail'))
            <div class="card red darken-1">
                <div class="row">
                    <div class="col s12 m12 info">
                        <p>{{ Session::get('fail') }}</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>