<!-- Stored in resources/views/index.blade.php -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@extends('layouts.master')

@section('title', 'Page Title')

@section('navbar')
    @parent
@endsection

@section('content')
    <p>Page analysis</p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">URL</th>
                <th scope="col">Status code</th>
                <th scope="col">Content length</th>
                <th scope="col">H1</th>
                <th scope="col">Keywords</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $domain->url_adress }}</td>
                <td>{{ $domain->status_code }}</td>
                <td>{{ $domain->content_length }}</td>
                <td>{{ $domain->h1 }}</td>
                <td>{{ $domain->keywords }}</td>
                <td>{{ $domain->description }}</td>
            </tr>
        </tbody>
    </table>

@endsection
