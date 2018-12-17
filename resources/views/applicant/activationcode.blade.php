@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-md-8">
    <br>
    <br>
    <h2>@lang('messages.activate_title')</h2>
    <br>
    <br>

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> {{$errors->first()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <form action="/mannheim-exchange/activate" method="POST">
      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">@lang('messages.activate_form_label')</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="code" placeholder="..." required>
        </div>
        <div class="col-sm-4">
          <button class="btn btn-primary" type="submit">@lang('messages.activate_action')</button>
        </div>
      </div>
      {{ csrf_field() }}
    </form>

  </div>

</div>

@endsection
