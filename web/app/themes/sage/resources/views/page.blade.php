@extends('layouts.app')

@section('content')
  <h1>
    {{ $foo }}
  </h1>
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @includeFirst(['partials.content-page', 'partials.content'])

    <x-latest-posts :args="[
      'posts_per_page' => 3
    ]">
      <h1>Derniers articles</h1>
    </x-latest-posts>
  @endwhile
@endsection

@section('sidebar')
  <h1 style="font-size: 50px">Sidebar</h1>
@endsection
