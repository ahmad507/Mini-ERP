<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])
        
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <style>
            .table-row {
                cursor: pointer;
            }
        </style>
        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')
    @include('sweetalert::alert')

    <script>
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var sid = button.data('mid')
            var scode = button.data('mcode')
            var scutting_id = button.data('mcutting_id')
            var streatment = button.data('mtreatment')
            var ssudut = button.data('msudut')
            var sclass = button.data('mclass')
            var sstock = button.data('mstock')
            var sempty = button.data('mempty')
            var ssch = button.data('msch')
            var sact = button.data('mstock')
            var sposition = button.data('mposition')
            var modal = $(this)
            modal.find('.modal-body #id').val(sid);
            modal.find('.modal-body #code').val(scode);
            modal.find('.modal-body #cutting_id').val(scutting_id);
            modal.find('.modal-body #material').val(streatment);
            modal.find('.modal-body #sudut').val(ssudut);
            modal.find('.modal-body #class').val(sclass);
            modal.find('.modal-body #stock').val(sstock);
            modal.find('.modal-body #datetimepicker').val(sempty);
            modal.find('.modal-body #sch').val(ssch);
            modal.find('.modal-body #act').val(sact);
            modal.find('.modal-body #position').val(sposition);
        })
</script>
<script>
            $('#editProduct').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var vid = button.data('nid')
            var vitem_code = button.data('nitem_code')
            var vbarcode = button.data('nbarcode')
            var vqty = button.data('nqty')
            var vstorage_id = button.data('nstorage_id')
            var voperator = button.data('noperator')
            var modal = $(this)
            modal.find('.modal-body #id').val(vid);
            modal.find('.modal-body #item_code').val(vitem_code);
            modal.find('.modal-body #barcode').val(vbarcode);
            modal.find('.modal-body #qty').val(vqty);
            modal.find('.modal-body #storage_id').val(vstorage_id);
            modal.find('.modal-body #operator').val(voperator);
        })
</script>
<script>
            $('#storeOrder').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var kid = button.data('did')
            var kitem_code = button.data('ditem_code')
            var kqty = button.data('dqty')
            var koprt = button.data('doprt')
            var modal = $(this)
            modal.find('.modal-body #id').val(kid);
            modal.find('.modal-body #item_code').val(kitem_code);
            modal.find('.modal-body #qty').val(kqty);
            modal.find('.modal-body #oprt').val(koprt);
        })
</script>
<script>
            $('#editOrder').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var kid = button.data('did')
            var kitem_code = button.data('ditem_code')
            var kqty = button.data('dqty')
            var kmachine_bld = button.data('dmachine_bld')
            var koprt = button.data('doprt')
            var kkanban_id = button.data('dkanban_id')
            var kflag = button.data('dflag')
            var knote = button.data('dnote')
            var kcreated_at = button.data('dcreated_at')
            var modal = $(this)
            modal.find('.modal-body #id').val(kid);
            modal.find('.modal-body #item_code').val(kitem_code);
            modal.find('.modal-body #qty').val(kqty);
            modal.find('.modal-body #machine_bld').val(kmachine_bld);
            modal.find('.modal-body #oprt').val(koprt);
            modal.find('.modal-body #kanban_id').val(kkanban_id);
            modal.find('.modal-body #flag').val(kflag);
            modal.find('.modal-body #note').val(knote);
            modal.find('.modal-body #datetimepicker').val(kcreated_at);
        })
</script>
<script>
            $('#deleteOrder').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var kid = button.data('did')
            var modal = $(this)
            modal.find('.modal-body #id').val(kid);
        })
</script>

</body>
</html>
