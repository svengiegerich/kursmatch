@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<ul class="nav justify-content-center nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="{{url('/applicant/' . $aid)}}">@lang('messages.nav_step_1')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('/applicant/programs/' . $aid)}}">@lang('messages.nav_step_2')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">@lang('messages.nav_step_3')</a>
  </li>
</ul>

<br><br>

<div class="row justify-content-center">
    <div class="col-md-8">

        <noscript>
          <div class="alert alert-danger" role="alert">
            Your need to activate javascript for Kursmatch! Please enable it first before proceeding.
          </div>
        </noscript>

        <h3>@lang('messages.preferences_title', ['aid' => $aid])</h3>

        <p>@lang('messages.preferences_manual_text_1')</p>

        <br>

        <div class="form-group row justify-content-md-center">
          <div class="col-sm-6">
            <select class="form-control" name="preference_onetwo" id="preference_onetwo" required>
              <option class="-1"
                @if (isset($_GET["select"]) && (int)$_GET["select"] == -1)
                  selected
                @endif
                >---</option>
              <option value="1"
                @if (isset($_GET["select"]) && (int)$_GET["select"] == 1)
                  selected
                @endif
                >@lang('messages.preference_select_onetwo_1')</option>
              <option
              @if (isset($_GET["select"]) && (int)$_GET["select"] == 2)
                selected
              @endif
               value="2">@lang('messages.preference_select_onetwo_2')</option>
            </select>
          </div>
        </div>
      </div>
</div>

<br>
<br>

<div class="row justify-content-center" id="p">
        <div class="col-md-8">
          @if (count($preferences) < 3)
          @endif

          <h3>@lang('messages.preferences_add_title')</h3>

          <div id="preferences_manual_text_2_couple">
            <p>@lang('messages.preferences_manual_text_2_couple')</p>
          </div>
          <div id="preferences_manual_text_2_single">
            <p>@lang('messages.preferences_manual_text_2_single')</p>
          </div>

        </div>
        <div class="col-md-8 bg-light" id="s" style="padding: 25px;">
        @if (count($programs1)>0)
        <form action="{{url('/applicant/programs/' . $aid)}}#s" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h5>Indicate your seminar preferences</h5>

            <hr class="mb-4 col-md-10">

            <div class="form-group row" id="select_group_1">
                <label for="to" class="col-sm-3 col-form-label">@lang('messages.preferences_add_select_1_label')</label>
                <div class="col-sm-9">
                    {!! Form::select('to_1', $programs1,false,
                        array('id' => 'preference-id-to-1',
                              'class' => 'form-control')
                    )  !!}
                </div>
            </div>
            <hr class="mb-4 col-md-10">
            <div class="form-group row"   id="select_group_2">
              <label for="to_2" class="col-sm-3 col-form-label">@lang('messages.preferences_add_select_2_label')</label>
              <div class="col-sm-9">
                  {!! Form::select('to_2', $programs2,false,
                      array('id' => 'preference-id-to-2',
                            'class' => 'form-control', 'required' => '')
                  )  !!}
              </div>
              <hr class="mb-4 col-md-10">
                </div>

<!--<small class="text-muted">@lang('messages.preferences_add_note_few_prefs')</small>
<br><br>-->

  @if (count($programs1)>0)
  <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('messages.preferences_add_action')</button>
  @else
  <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('messages.preferences_add_action_zero')</button>
  @endif

</form>
@else
<button type="submit" class="btn btn-dark" disabled>@lang('messages.preferences_add_action_all')</button>
@endif
</div>
</div>

<br>
<br>
<br>

<div class="row justify-content-center" id="r">
      @if (count($preferences) > 0)
      <div class="col-md-8">
        <h3>@lang('messages.preferences_show_title')</h3>
        <div id="preferences_manual_text_3_couple">
          <p>@lang('messages.preferences_manual_text_3_couple')</p>
        </div>
        <div id="preferences_manual_text_3_single">
          <p>@lang('messages.preferences_manual_text_3_single')</p>
        </div>

        @if (count($preferences) < 3)
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{count($preferences)/3*100}}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
        <br>
        <div class="alert alert-warning" role="alert">
          @lang('messages.preferences_show_note_min_prefs')
        </div>
      @endif
      <small class="text-muted">@lang('messages.preferences_show_note_privacy')</small>
      <br>

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Warning!</strong> {{$errors->first()}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      </div>
    <div class="col-md-10">
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {
              $('#sortable').sortable({
                axis: 'y',
                update: $( "#sortable" ).bind( "sortupdate", function(event, ui) {
                  var order = $(this).sortable('serialize');
                  var _token = $("input[name=_token]").val();
                  var data = {"order": order, "_token": _token};

                  $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{url('/applicant/preferences/reorder/' . $preferences->first()->id_from)}}',
                    success: function(data) {
                      console.log(data);

                      $('.rank strong').each(function (i) {
                          var humanNum = i + 1;
                          $(this).html(humanNum);
                      });
                    }
                  });
                  ui.item.sortable.index
                })
              })

              .on('click', '.delete', function() {
                $(this).closest('li').remove();
                var data = {'itemId': $(this).closest('li').attr('id')};
                $.ajax({
                  data: data,
                  type: 'POST',
                  url: '{{url('/applicant/preferences/delete/' . $preferences->first()->id_from)}}',
                    success: function(data) {
                    console.log(data);
                    //todo: add element to dropdown
                  }
                });
              });

              $(".u").click(function() {
              var li = $(this).parents("li:first");
              li.insertBefore(li.prev());
              $('#sortable').trigger('sortupdate');
              });

              $(".d").click(function() {
                var li = $(this).parents("li:first");
                li.insertAfter(li.next());
                $('#sortable').trigger('sortupdate');
              });

              //$("#preference_onetwo").
              //show / add select_2 and option 3 by 'preference_onetwo'

              $( "#sortable" ).disableSelection();
            });
        </script>

        <ul id="sortable" class="list-group">
            {{ csrf_field() }}
            <?php $i = 1; ?>
            @foreach ($preferences as $preference)
                <li id="item-{{$preference->prid}}" class="ui-state-default list-group-item d-flex justify-content-between align-items-center" style="margin-top:22px;">
                  <ion-icon name="arrow-round-up" class="u"></ion-icon>
                  <ion-icon name="arrow-round-down" class="d"></ion-icon>
                    <span class="rank col-1-md rank" id="rank-index"><strong>{{$i}}</strong></span>
                    <span class="col-10">{{$preference->programNames}}
                    </span>

                    <a class="delete" href="#p" style="padding-top: 5px;"><ion-icon name="close-circle-outline"></ion-icon></a>
                </li>
                <?php $i++; ?>
             @endforeach
        </ul>
        <br>
        <a href="#s" style="text-align: center;">
          <i>@lang('messages.preferences_show_next_pref')</i>
        </a>
      </div>
        @else
          <div class="col-md-10">
            @lang('messages.preferences_show_no_pref')
          </div>
        @endif
</div>

@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8">
        <br><br><br>
        <hr class="mb-4">
        <a href="{{url('/applicant/submitted/' . $applicant->aid)}}"><button class="btn btn-lg btn-primary btn-block">@lang('messages.preferences_action_submit')</button></a>
        <small class="text-muted">@lang('messages.preferences_action_submit_note')</small>
        <hr class="mb-4">
    </div>
</div>
@endif

<script>

  $(function(){
    //https://teamtreehouse.com/community/disable-a-selected-option-if-is-selected-already
    //http://jsfiddle.net/sLaj30yy/
    $( document ).ready(function() {
        var val = $('#preference_onetwo').val();
        if (val == 1) {
          $('#select_group_1').show();
          $('#select_group_2').hide();
          $('#preferences_manual_text_2_single').show();
          $('#preferences_manual_text_2_couple').hide();
          $('#preferences_manual_text_3_single').show();
          $('#preferences_manual_text_3_couple').hide();
        } else if (val == 2) {
          $('#select_group_1').show();
          $('#select_group_2').show();
          $('#preferences_manual_text_2_single').hide();
          $('#preferences_manual_text_2_couple').show();
          $('#preferences_manual_text_3_single').hide();
          $('#preferences_manual_text_3_couple').show();
        } else {
          $('#select_group_1').show();
          $('#select_group_2').show();
          $('#preferences_manual_text_2_single').hide();
          $('#preferences_manual_text_2_couple').show();
          $('#preferences_manual_text_3_single').hide();
          $('#preferences_manual_text_3_couple').show();
        }
    });

    $('#preference_onetwo').on('change', function () {
      var val = $(this).val();
      if (val == 1) {
        $('#select_group_1').show();
        $('#select_group_2').hide();
        $('#preferences_manual_text_2_single').show();
        $('#preferences_manual_text_2_couple').hide();
        $('#preferences_manual_text_3_single').show();
        $('#preferences_manual_text_3_couple').hide();
      } else if (val == 2) {
        $('#select_group_1').show();
        $('#select_group_2').show();
        $('#preferences_manual_text_2_single').hide();
        $('#preferences_manual_text_2_couple').show();
        $('#preferences_manual_text_3_single').hide();
        $('#preferences_manual_text_3_couple').show();
      }
    });

    var $select1 = $("#preference-id-to-1");
    var $select2 = $("#preference-id-to-2");
    $select1.on("change", function() {
      var selected = [];
      $.each($select1, function(index, select) {
        if (select.value !== "") { selected.push(select.value); }
      });
      $("option").prop("disabled", false);
      for (var index in selected) {
        if (selected[index] != -1) { //exclude only to-1 option
          $('#preference-id-to-2 option[value="'+selected[index]+'"]').prop("disabled", true);
        }
      }
    });

    $select2.on("change", function() {
      var selected = [];
      $.each($select2, function(index, select) {
        if (select.value !== "") { selected.push(select.value); }
      });
      $("option").prop("disabled", false);
      for (var index in selected) {
        if (selected[index] != -1) { //exclude only to-1 option
          $('#preference-id-to-1 option[value="'+selected[index]+'"]').prop("disabled", true);
        }
      }
      document.getElementById("preference_add").selectedIndex = "1";
    });
  });
</script>

<script src="https://unpkg.com/ionicons@4.3.0/dist/ionicons.js"></script>

@endsection
