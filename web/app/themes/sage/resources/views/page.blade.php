@extends('layouts.app')

@section('content')
  <h1>
    {{ $foo }}
  </h1>
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @includeFirst(['partials.content-page', 'partials.content'])
  @endwhile
@endsection

@section('sidebar')
  <h1 style="font-size: 50px">Sidebar</h1>
@endsection
