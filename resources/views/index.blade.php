<!-- Stored in resources/views/index.blade.php -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@extends('layouts.master')

@section('title', 'Page Title')

@section('master')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>


        <div class="list-group">
            @foreach ($domains as $domain)
               <a href="{{ $domain->name }}" class="list-group-item list-group-item-action">{{ $domain->name }}</a>
            @endforeach
        </div>

    {{ $domains->links() }}

@endsection
