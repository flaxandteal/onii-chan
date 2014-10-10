<div id='company-box'>
  <div class='company-header'>
    <div class='company-header-line'>
      <div class='company-title'>
        {{ $company->title() }}
      </div>
      <div class='company-endorsements'>
        [endorsements: 4]
      </div>
    </div>
    <div class='company-link-bar'>
      <div class='company-url'>
        www.flaxandteal.co.uk
      </div>
      <div class='company-email'>
        info@flaxandteal.co.uk
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
          <td>Belfast</td>
          <td>LTD < 5</td>
          <td>{{ $company->yearStarted() }}</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Interested in</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>Web dev, mathematics, education, open source advocacy.</td>
        </tr>
        <tr>
          <td colspan=3 class='-mild-highlighted'>Joint collaborations; new clients</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Experience</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>New Zealand video tutorials service</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Technologies</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>Python, C/C++, PHP, Drupal, Laravel</td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <td colspan=3>Career Seekers</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3>Junior web developer (1 pos.)</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

