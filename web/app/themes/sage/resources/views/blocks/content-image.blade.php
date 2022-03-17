<div class="content-image">
  @if ($title = get_field('block_title'))
    <h2>{{ $title }}</h2>
  @endif
  @if ($content = get_field('block_content'))
    <div>
      {!! $content !!}
    </div>
  @endif
  @if ($imageId = get_field('block_image'))
    {!! wp_get_attachment_image($imageId) !!}
  @endif
</div>
