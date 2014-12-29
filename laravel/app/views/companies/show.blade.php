<div id='company-box'>
  <div class='company-header'>
    <div class='company-header-line'>
      <div class='company-title'>
        {{ $company->title }}
      </div>
      <div class='company-endorsements'>
        [endorsements: 4]
      </div>
    </div>
    <div class='company-link-bar'>
      <div class='company-url'>
        {{ $company->url }}
      </div>
      <div class='company-email'>
        {{ $company->email }}
      </div>
    </div>
  </div>
  <div class='company-content'>
    <div class='company-logo'>
      {{ HTML::image('images/sample/flaxandteal-logo.png') }}
    </div>
    <div class='company-blurb'>
      <p>Flax &amp; Teal is a Belfast-based contracting
      company. In-house experience in web
      development, engineering and mathematics.
      interested in collaborations oriented 
      around numerical analysis or web solutions.</p>

      <p>The company is focused on developing European links
      with international Commonwealth projects, and Northern
      Ireland internal collaboration.</p>
    </div>
  </div>
  <div class='company-statistics'>
    <table>
      <thead>
        <tr class='cs-main-row'>
          <td>Location</td>
          <td>Size</td>
          <td>Founded</td>
        </tr>
      </thead>
      <tbody>
        <tr class='cs-main-row'>
          <td>{{ $company->location }}</td>
          <td>{{ $company->size }}</td>
          <td>{{ $company->yearStarted }}</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Interested in</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>{{ $company->interestedIn }}</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Experience</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>{{ $company->experience }}</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Technologies</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>{{ $company->technologies }}</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Career Seekers</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>{{ $company->vacancies }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
