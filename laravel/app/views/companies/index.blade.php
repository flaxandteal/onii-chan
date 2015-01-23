<ul>
@foreach ($companies as $company)
  <li><a class="l-endorsements-{{ $company->endorsements() > 1 ? '2+' : $company->endorsements() }}" href="javascript:display_company('{{ $company->id() }}')">{{ $company->title() }}</a></li>
@endforeach
</ul>
