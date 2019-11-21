<!-- Stored in resources/views/main.blade.php -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@extends('layouts.navbar')

@section('title', 'Page Title')

@section('navbar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>
    <form action="/domains" method="post">
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