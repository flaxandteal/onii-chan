@extends('layouts.scaffold')

@section('main')

<h1>Show Listing</h1>

<p>{{ link_to_route('listings.index', 'Return to All listings', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Company_id</th>
				<th>Interested_in</th>
				<th>Interested_in_categories</th>
				<th>Experience</th>
				<th>Technologies</th>
				<th>Career_seekers</th>
				<th>Seeking</th>
				<th>Tags</th>
				<th>Sections</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $listing->company_id }}}</td>
					<td>{{{ $listing->interested_in }}}</td>
					<td>{{{ $listing->interested_in_categories }}}</td>
					<td>{{{ $listing->experience }}}</td>
					<td>{{{ $listing->technologies }}}</td>
					<td>{{{ $listing->career_seekers }}}</td>
					<td>{{{ $listing->seeking }}}</td>
					<td>{{{ $listing->tags }}}</td>
					<td>{{{ $listing->sections }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('listings.destroy', $listing->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('listings.edit', 'Edit', array($listing->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
