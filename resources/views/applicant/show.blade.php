@extends('layouts.app')

@section('content')

<ul class="nav justify-content-center nav-pills">
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/applicant/' . $aid)}}">@lang('messages.nav_step_1')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">@lang('messages.nav_step_2')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">@lang('messages.nav_step_3')</a>
  </li>
</ul>

<br><br>

<div class="row justify-content-center">
  <div class="col-md-8">
    <h2>@lang('messages.intro_title', ['student_id' => $aid])</h2>
    <br>
  </div>

  <div class="col-md-8">

    <p>@lang('messages.intro_text_1')</p>
    <p>@lang('messages.intro_text_2')</p>

    <p>
      <a class="" data-toggle="collapse" href="#collapseDetailed" role="button" aria-expanded="false" aria-controls="collapseDetailed">
        More about the procedure
      </a>
    </p>
    <div class="collapse" id="collapseDetailed">
      <div class="card card-body">
        <p>@lang('messages.intro_text_3')</p>
      </div>
    </div>

    <br>

    <hr class="mb-4">

    <form action="{{url('/applicant/' . $aid)}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="aid" value="{{$aid}}"></input>
        <a href="https://www.vwl.uni-mannheim.de/">@lang('messages.intro_action_leave')</a>
        <br><br>

        <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('messages.intro_action', ['aid' => $aid])</button>
    </form>

  </div>
</div>

@endsection
