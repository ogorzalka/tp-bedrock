<a class="sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>

@include('sections.header')

  <x-alert type="warning">
    <h1>Test</h1>
    {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
  </x-alert>

  <x-message mood="sad" link="https://google.fr">
    <x-header level="2" className="test">
      <x-utilities.icon name="exclamation-triangle" />
      Hello World
    </x-header>
    <p>Je suis un message automatique</p>
  </x-message>

  <main id="main" class="main">
    @yield('content')
  </main>

  @hasSection('sidebar')
    <aside class="sidebar">
      @yield('sidebar')
    </aside>
  @endif

@include('sections.footer')
