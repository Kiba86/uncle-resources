@component('mail::message')

# {{$object}}

__from__ (<a href="mailto:{{$from}}">{{$from}}</a>)

{{$text}}


@endcomponent