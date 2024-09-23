@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv);
@endphp

<ul class="flex">
  @foreach($tags as $tag)
  <li class="flex items-center justify-center rounded-xl py-1 px-3 mr-2 text-xs" style="background-color: #D68C3C; color: #FFFFFF;">
    <a href="/?tag={{$tag}}" style="color: #FFFFFF;">{{$tag}}</a>
</li>

  @endforeach
</ul>