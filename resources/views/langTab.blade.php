@if (!empty($showAsField))
@include("admin::form._header")
@else
<div class="row has-many-head {{$column_class}}">
    <h4>{{ $label }}</h4>
</div>

<hr style="margin-top: 0px;" class="form-border m-0">
@endif

<div id="has-many-{{$column}}" class="{{$uniqueId}} has-many-{{$column}} nav-tabs-custom">
    @if (!$has_parent)
    <div class="pt-4 text-danger">Please save this item before adding transations.</div>
    @else
    <ul class="nav nav-tabs bg-white">
        @if(!empty($forms))
            @foreach($forms as $pk => $form)
                <li class="nav-item">
                    <a href="#{{$parentSelector}}{{ str_replace('.', '-', $relationName) . '_' . $pk }}" class="@if ($pk == config('app.locale')) active @endif  nav-link" data-bs-toggle="tab">
                        {{ config('translatable.native_locale.' . $pk, $pk) }} <i class="fa fa-exclamation-circle text-red hide"></i>
                    </a>
                </li>
            @endforeach
        @else

            @foreach($locales as $key => $locale)
                @if(is_array($locale))
                    @foreach($locale as $national)
                        @php
                            $language_index = $key . '-' . $national;
                        @endphp
                        <li class="nav-item">
                            <a href="#{{$parentSelector}}{{ str_replace('.', '-', $relationName) . '_' . $language_index }}" class="@if ($locale == config('app.locale')) active @endif nav-link" data-bs-toggle="tab">
                                {{ config('translatable.native_locale.' . $language_index, $language_index) }} <i class="fa fa-exclamation-circle text-red hide"></i>
                            </a>
                        </li>
                        @endforeach
                    @else
                    <li class="nav-item">
                        <a href="#{{$parentSelector}}{{ str_replace('.', '-', $relationName) . '_' . $locale }}" class="@if ($locale == config('app.locale')) active @endif nav-link" data-bs-toggle="tab">
                            {{ config('translatable.native_locale.' . $locale, $locale) }} <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    @endif

            @endforeach
        @endif

    </ul>

    <div class="{{$uniqueId}} tab-content has-many-{{$column}}-forms">

        @if(!empty($forms))
        @foreach($forms as $pk => $form)

            <div id="{{$parentSelector}}{{ str_replace('.', '-', $relationName) . '_' . $pk }}" class="{$uniqueId}} tab-pane fields-group has-many-{{$column}}-form @if ($pk == config('app.locale')) active @endif">
                @foreach($form->fields() as $field)
                    @php
                        $field->setParent($column,$pk);
                    @endphp

                    {!! $field->render() !!}
                @endforeach
            </div>
        @endforeach

        @else
            @foreach($locales as $key => $locale)
                @if(is_array($locale))
                    @foreach($locale as $national)
                        @php
                            $language_index = $key . '-' . $national;
                        @endphp
                        <div id="{{$parentSelector}}{{ str_replace('.', '-', $relationName) . '_' . $language_index }}" class="{{$uniqueId}} tab-pane fields-group has-many-{{$column}}-form @if ($language_index == config('app.locale')) active @endif" >

                            @foreach($template_fields as $field)
                                @php
                                    $field->setElementName($parentName.$columnName.'['. $language_index .'][' .$field->column() .']');
                                    $field->attribute('name',$parentName.$columnName.'['. $language_index .'][' .$field->column() .']');
                                    if($field->column() == 'locale'){
                                        $field->value($language_index);
                                    }
                                @endphp
                                {!! $field->render() !!}
                            @endforeach
                        </div>
                    @endforeach

                    @else

                    <div id="{{$parentSelector}}{{ str_replace('.', '-', $relationName) . '_' . $locale }}" class="{{$uniqueId}} tab-pane fields-group has-many-{{$column}}-form @if ($locale == config('app.locale')) active @endif">
                        @foreach($template_fields as $field)
                            @php
                                $field->setElementName($parentName.$columnName.'['. $locale .'][' .$field->column() .']');
                                $field->attribute('name',$parentName.$columnName.'['. $locale .'][' .$field->column() .']');
                                $field->attribute('title',$field->column());
                                if($field->column() == 'locale'){
                                    $field->value($locale);
                                }
                            @endphp
                            {!! $field->render() !!}
                        @endforeach

                    </div>
                @endif

            @endforeach
        @endif
    @endif
    </div>

</div>

@if (!empty($showAsField))
@include("admin::form._footer")
@endif
