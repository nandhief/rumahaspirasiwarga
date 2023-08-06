<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    @yield('css_up')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toggle/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jQueryUI/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/pace/pace.min.css') }}">
	<style>
		@media (max-width: 767px) {.fixed .content-wrapper, .fixed .right-side {padding-top: 50px; } } .colors {padding: 10px; width: 20px; border: solid 0.1px; } .default {background-color: #d4d4d4; } .default:hover {background-color: #c3c3c3 !important; } .warning {background-color: #fff4ba; } .danger {background-color: #f2dede; } .modal-xl {width: 96%; } .modal-body {max-height: calc(100vh - 145px); overflow-y: auto; }
        .ui-menu .ui-menu-item { padding: 5px; } .ui-autocomplete { z-index: 1111; }
	</style>
    @yield('css_down')
    <!--[if lt IE 9]>
        <script src="{{ asset('plugins/html5shiv/html5shiv.min.js') }}"></script>
        <script src="{{ asset('plugins/respond/respond.min.js') }}"></script>
    <![endif]-->
    <script>
        window.Laravel = {!! json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
        var module = {};
    </script>
</head>
<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
        @include('layouts.lte.header')

        @include('layouts.lte.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                @yield('content-header')

            </section>

            <section class="content">
                @yield('content')

            </section>
        </div>
        <footer class="main-footer">
            <strong>RAW &copy;</strong> All rights reserved.
        </footer>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/locale/id.js') }}"></script>
    <script src="{{ asset('plugins/noty/jquery.noty.packaged.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.yajra.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/jqueryform/jquery.form.min.js') }}"></script>
    <script src="{{ asset('plugins/toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.id.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script>
        $(document).ajaxStart(function () {
            Pace.restart();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        });

        $('.sidebar-menu').tree()

        $('[data-toggle="tooltip"]').tooltip()

        var activeSub = $(document).find('.active-sub');
        if (activeSub.length > 0) {
            activeSub.parent().show();
            activeSub.parent().parent().find('.arrow').addClass('open');
            activeSub.parent().parent().addClass('open');
        }

        function notif(message, type = 'success') {
            noty({
                text: message,
                type: type,
                layout: 'topRight',
                theme: 'relax',
                dismissQueue: true,
                force: true,
                maxVisible: 5,
                timeout: 4000,
                progressBar: true,
                closeWith: ['click'],
                template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>'
            });
        }
        function notifError(data) {
            notif(data.message, 'error');
            $.each(data.errors, function (i,v) {
                notif(v, 'error');
            });
        }

        window.multiModal = (params = {}) => {
            var id = params.key || 'm' + (+ new Date)
            $('body').append('<div id="'+id+'" class="modal fade"><style>.modal-title{display:inline;}.modal-xl{width:96%;}.modal-body{max-height: calc(100vh - 145px);overflow-y: auto;}</style>' +
            '<div class=modal-dialog><div class=modal-content>' +
            '<div class=modal-header><button type=button class="x close" data-dismiss=modal aria-label="Close"><span aria-hidden=true>&times;</span></button><h5 class=modal-title></h5></div>' +
            '<div class="modal-body"></div>' +
            '<div class="modal-footer"></div>' +
            '</div></div></div>')
            var modal = $('#'+id)
            var body = modal.find('.modal-body')
            var footer = modal.find('.modal-footer')
            if (params.backdrop) modal.attr('data-backdrop', 'static')
            modal.find('.modal-dialog').addClass('modal-' + (params.size || 'md'))
            modal.find('.modal-title').html(params.title || 'Title')
            if(Array.isArray(params.footer)) {
                $.each(params.footer, (i,v) => {
                    var close = v.close ? ' data-dismiss="modal"' : ''
                    var btn = `<button type="button" class="btn btn-flat btn-${v.style || 'default'}" ${close}>${v.text}</button>`
                    if (v.click) {
                        btn = $(btn).click(v.click)
                    }
                    footer.append(btn)
                })
            }
            modal.modal()
            body.html('<h5>Loading...</h5><div class=progress><div class="progress-bar progress-bar-green progress-bar-striped active" style="width: 100%"></div></div>')
            if (typeof(params.message) != 'undefined') {
                body.html(params.message)
            } else {
                var options = {
                    headers: {'Accept': 'application/json'},
                    url: params.url || '',
                    type: params.type || 'GET',
                    data: params.data || {},
                }
                $.ajax(options).done(result => {
                    body.html(result)
                }).fail(errors => {
                    body.html('<div class="alert alert-danger"><strong>Fail: </strong>' + errors.responseJSON.message + '</div>')
                })
            }
            modal.on('shown.bs.modal', e => {
                $('.popover').popover('hide')
                $('.tooltip').tooltip('hide')
                if ($('.modal').length > 1 ) $('.modal-backdrop:nth-last-child(1)').css('opacity', '0.01')
            })
            modal.on('hidden.bs.modal', e => {
                $(e.target).remove()
                $('.popover').popover('hide')
                $('.tooltip').tooltip('hide')
            })
        }
    </script>
    @yield('js')
</body>
</html>
