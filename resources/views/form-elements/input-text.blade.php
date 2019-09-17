{{--[
    'label' => 'Label',
    'name' => 'input_name',
    'required' => null / 1,
    'value' => $form->value,
    'sublabel' => 'Sub-label'
]--}}
<div class="form-group row"><label for="form_{{$name}}" class="col-2 col-form-label control-label">{!! $label !!}@isset($sublabel)<br><span>{!! $sublabel !!}</span>@endisset</label><div class="col-10"><input id="form_{{$name}}" value="{{ $value }}" class="form-control" name="{{$name}}" type="text"@isset($required) required @endisset></div></div>
