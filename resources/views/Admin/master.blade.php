<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ $systemLogo ? asset('admin/logo/' . $systemLogo) : asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('build/assets/app-f15cd5ac.css') }}">
    <title>Dashboard - পাঞ্জাবিওয়ালা</title>
    <!-- BEGIN: CSS Assets-->
    @include('Admin.include.styles')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
<!-- BEGIN: Mobile Menu -->
@include('Admin.partials.mobile-menu')

<!-- END: Mobile Menu -->
<div class="flex overflow-hidden">
    <!-- BEGIN: Side Menu -->
    @include('Admin.partials.side-menu')
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('Admin.partials.top-bar')
        <!-- END: Top Bar -->
        @yield('content')
    </div>
    <!-- END: Content -->
</div>
<!-- BEGIN: Dark Mode Switcher-->
@include('Admin.partials.dark-mode-switcher')
<!-- END: Dark Mode Switcher-->

<!-- BEGIN: JS Assets-->
@include('Admin.include.scripts')
<script src="{{ asset('build/assets/app-73b80cb8.js') }}"></script>
<!-- END: JS Assets-->
</body>
</html>
