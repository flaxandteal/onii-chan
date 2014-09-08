@extends('layouts.scaffold')

@section('main')

<h1>All Companies</h1>

<p>{{ link_to_route('companies.create', 'Add New Company', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($companies->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>User_id</th>
				<th>Listing_id</th>
				<th>Name</th>
				<th>Type_id</th>
				<th>Website</th>
				<th>Endorsements</th>
				<th>Location</th>
				<th>Size</th>
				<th>Founded</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($companies as $company)
				<tr>
					<td>{{{ $company->user_id }}}</td>
					<td>{{{ $company->listing_id }}}</td>
					<td>{{{ $company->name }}}</td>
					<td>{{{ $company->type_id }}}</td>
					<td>{{{ $company->website }}}</td>
					<td>{{{ $company->endorsements }}}</td>
					<td>{{{ $company->location }}}</td>
					<td>{{{ $company->size }}}</td>
					<td>{{{ $company->founded }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('companies.destroy', $company->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('companies.edit', 'Edit', array($company->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no companies
@endif

@stop
