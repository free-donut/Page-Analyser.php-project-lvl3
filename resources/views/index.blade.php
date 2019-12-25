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
    <table class="table">
        <thead>
            <tr>
                <th scope="col">URL</th>
                <th scope="col">Status code</th>
                <th scope="col">Contentlength</th>
            </tr>
        </thead>
        <tbody>
        <div class="list-group">
            @foreach ($domains as $domain)
            <tr>
                <td><a href="{{ $domain->url_adress }}" class="card-link">{{ $domain->url_adress }}</a></td>
                <td>{{ $domain->status_code }}</td>
                <td>{{ $domain->content_length }}</td>
            </tr>
            @endforeach
        </div>
        </tbody>
    </table>
    {{ $domains->links() }}

@endsection
