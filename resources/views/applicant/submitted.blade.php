@extends('layouts.app')

@section('content')

<ul class="nav justify-content-center nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="{{url('/applicant/' . $aid)}}">@lang('messages.nav_step_1')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/applicant/programs/' . $aid)}}">@lang('messages.nav_step_2')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/applicant/submitted/' . $aid)}}">@lang('messages.nav_step_3')</a>
  </li>
</ul>

<br><br>

<div class="row justify-content-center">
  <div class="col-md-8">

<h3>@lang('messages.preferences_submitted_title')</h3>

<br>

<p>@lang('messages.preferences_submitted_text_1')</p>
<p>@lang('messages.preferences_submitted_text_2')</p>
<p>@lang('messages.preferences_submitted_text_3')</p>

<br>

<hr>

<br>

</div></div>

<br><br><br>

@endsection
