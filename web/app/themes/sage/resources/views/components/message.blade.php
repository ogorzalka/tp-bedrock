@if ($mood === 'sad')
  <div style="background-color: yellow; color: blue">
@else
  <div style="background-color: pink; color: blue">
@endif
    {{ $slot }}

    {!! $linkHtml !!}
  </div>
