<ul>
@foreach ($companies as $company)
  <li><a href="javascript:display_company('{{ $company->id }}')">{{ $company->title }}</a></li>
@endforeach
</ul>
