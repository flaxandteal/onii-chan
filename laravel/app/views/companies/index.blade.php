@foreach ($companies as $company)
  <li>{{ $company->title() }} ({{ $company->yearStarted() }})</li>
@endforeach
