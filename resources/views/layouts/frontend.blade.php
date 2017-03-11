<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
        <meta name="description" content="description">
        <meta name="keywords" content="keywords">
        <meta property="og:url" content="{!! Request::url() !!}" />
        <meta property="og:type"   content="website" />
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="300">
        <meta property="og:image:height" content="300">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        {{ HTML::style(mix('assets/css/frontend/app.css')) }}
    </head>
    <body>
        <div id="app"></div>
        {{ HTML::script(mix('assets/vue/frontend/manifest.js')) }}
        {{ HTML::script(mix('assets/vue/frontend/vendor.js')) }}
        {{ HTML::script(mix('assets/vue/frontend/app.js')) }}
    </body>
</html>
