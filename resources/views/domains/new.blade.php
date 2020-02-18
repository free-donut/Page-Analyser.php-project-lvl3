<!-- Stored in resources/views/main.blade.php -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@extends('layouts.master')

@section('title', 'Page Title')

@section('navbar')
    @parent
@endsection

@section('content')
    <p>This is the page SEO-analyzer</p>

@if (isset($errors))
  @foreach ($errors as $message)
      <div class="alert alert-warning" role="alert">
        {{ $message }}
      </div>
  @endforeach
@endif

    <form action="{{ route('domains.store') }}" method="post">
      <div class="form-row align-items-center">
        <div class="col-sm-3 my-1">
          <label class="sr-only" for="inlineFormInputName">URL</label>
          <input type="text" name ="url" class="form-control" id="inlineFormInputName" placeholder="Enter webpage URL">
        </div>
        <div class="col-auto my-1">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>

@endsection
