<img
    data-src='{{ $src }}'
    src='data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='
    @if (isset($alt))
    alt='{{ $alt }}'
    @endif
    @if (isset($w))
    width='{{ $w }}'
    @endif
    @if (isset($h))
    height='{{ $h }}'
    @endif
    class='lazyload {{ $class }}'
>
