<meta property="fb:app_id" content="{{ Config::get('social.facebook.id') }}">
<meta property="og:title" content="{{$social->title}}">
<meta property="og:description" content="{{$social->desc}}">
<meta property="og:url" content="{{$social->url}}">
<meta property="og:type" content="article">
<meta property="og:locale" content="en_US" />
<meta property="og:image" content="{{$social->image}}">
<meta property="og:image:width" content="{{$social->img_width}}">
<meta property="og:image:height" content="{{$social->img_height}}">
<meta name="description" content="{{$social->desc}}">

<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{$social->title}}">
<meta name="twitter:description" content="{{$social->desc}}">
<meta name="twitter:image" content="{{$social->image}}">

<meta itemprop="name" content="{{$social->title}}">
<meta itemprop="description" content="{{$social->desc}}">
<meta itemprop="image" content="{{$social->image}}">