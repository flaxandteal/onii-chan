@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Listing</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'listings.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('company_id', 'Company_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'company_id', Input::old('company_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('interested_in', 'Interested_in:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('interested_in', Input::old('interested_in'), array('class'=>'form-control', 'placeholder'=>'Interested_in')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('interested_in_categories', 'Interested_in_categories:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('interested_in_categories', Input::old('interested_in_categories'), array('class'=>'form-control', 'placeholder'=>'Interested_in_categories')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('experience', 'Experience:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('experience', Input::old('experience'), array('class'=>'form-control', 'placeholder'=>'Experience')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('technologies', 'Technologies:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('technologies', Input::old('technologies'), array('class'=>'form-control', 'placeholder'=>'Technologies')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('career_seekers', 'Career_seekers:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('career_seekers', Input::old('career_seekers'), array('class'=>'form-control', 'placeholder'=>'Career_seekers')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('seeking', 'Seeking:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('seeking', Input::old('seeking'), array('class'=>'form-control', 'placeholder'=>'Seeking')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('tags', 'Tags:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('tags', Input::old('tags'), array('class'=>'form-control', 'placeholder'=>'Tags')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('sections', 'Sections:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('sections', Input::old('sections'), array('class'=>'form-control', 'placeholder'=>'Sections')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}

@stop


