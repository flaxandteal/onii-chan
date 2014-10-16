<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
  <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'>
  {{ HTML::style('css/chunk-five.css') }}
  {{ HTML::style('css/league-gothic.css') }}
  {{ HTML::style('css/main.css') }}
  {{ HTML::style('css/top-menu.css') }}
  {{ HTML::style('css/search-banner.css') }}
  {{ HTML::style('css/content.css') }}
  {{ HTML::style('css/individual-company.css') }}
  {{ HTML::style('css/listings.css') }}
  {{ HTML::style('css/footer.css') }}
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src='/js/browse.js'></script>
</head>
<body>
<div id='page-container'>
  <div id='top-menu'>
    <div id='background'>
      {{ HTML::image('images/logo.png', 'OpenNI Index Logo - opened hexagon', array('id' => 'logo')) }}
      {{ HTML::image('images/header.png') }}
    </div>
    <div id='top-menu-upper'>
      <ul>
        <li>&#x25aa;</li>
        <li><p>All listings</p> <img src='images/icons/all-listings.png'/></li>
        <li>&#x25aa;</li>
        <li><p>Create listing</p> <img src='images/icons/create-listing.png'/></li>
        <li>&#x25aa;</li>
      </ul>
    </div>
    <div id='top-menu-lower'>
      <ul>
        <li>News</li>
        <li class='sep'></li>
        <li>Info</li>
        <li class='sep'></li>
        <li>Contact</li>
      </ul>
    </div>
    <div id='top-menu-login'>
      Login
    </div>
  </div>
  <div id='search-banner'>
    <div id='search-banner-linen'>
      {{ HTML::image('images/linen.png') }}
    </div>
    <div id='search-banner-box-group'>
      <div id='search-banner-glass'>
        {{ HTML::image('images/glass.png') }}
      </div>
      <div id='search-banner-title'>
        Explore our listings
      </div>
      <div id='search-banner-textbox'>
        <div id='search-banner-textbox-real'>
        {{ Form::open(array('route' => 'company.index', 'method' => 'GET')) }}
          {{ Form::text('search', null, array('name' => 'query')) }}
        {{ Form::close() }}
        </div>
        <div id='search-banner-textbox-label'>
          ...Search
        </div>
      </div>
    </div>
    <div id='search-filters'>
        <div id='search-filters-bar' class='sfb-inactive'>
        </div>
        <div id='search-filters-activate'>
          &#x21e8; Click to show search filters
        </div>
    </div>
  </div>
  <div id='content'>
    <div id='content-background'>
      {{ HTML::image('images/wallpaper.png') }}
    </div>
    <div id='content-container'>
      <div id='company-matching-listings'>
        <div id='listings-background'>
          {{ HTML::image('images/listings-background.png') }}
        </div>
        <div id='listings-count'>
          <span id='listings-count-digits'>N</span> matching listings
        </div>
        <div id='listings'>
          <div id='listings-list'>
          </div>
          <div id='listings-arrows'>
            <img id='listings-arrows-up' src='images/listings-up-right.png'>
            <img id='listings-arrows-down' src='images/listings-down-right.png'>
          </div>
        </div>
      </div>
      <div id='individual-company'>
        <div id='individual-company-buttons'>
          <div id='individual-company-button-1'>
            <div class='icb-pair'>
              <div class='icb-icon'>{{ HTML::image('images/icons/collaboration.png') }}</div>
              <div class='icb-text'>Collaborate</div>
            </div>
            <div class='icb-underscore'></div>
          </div>
          <div id='individual-company-button-2'>
            <div class='icb-pair'>
              <div class='icb-icon'>{{ HTML::image('images/icons/request-quote.png') }}</div>
              <div class='icb-text'>Request Quote</div>
            </div>
            <div class='icb-underscore'></div>
          </div>
          <div id='individual-company-button-3'>
            <div class='icb-pair'>
              <div class='icb-icon'>{{ HTML::image('images/icons/invite-to-tender.png') }}</div>
              <div class='icb-text'>Invite to Tender</div>
            </div>
            <div class='icb-underscore'></div>
          </div>
        </div>
        <div id='company-box'>
          <div class='company-header'>
            <div class='company-header-line'>
              <div class='company-title'>
                Flax &amp; Teal Limited
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
                  <td>2013</td>
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
      </div>
    </div>
  </div>
  <div id='footer'>
    <div id='footer-top-spacer'></div>
    <div id='nav-menus'>
      <div class='nav-menu -highlighted' id='nav-menu-user'>
        <h2>User</h2>
        <ul>
          <li>Account</li>
          <li>My listings</li>
          <li>Login</li>
        </ul>
      </div>
      <div class='nav-menu' id='nav-menu-general'>
        <h2>General</h2>
        <ul>
          <li>News</li>
          <li>Info</li>
        </ul>
      </div>
      <div class='nav-menu' id='nav-menu-listings'>
        <h2>Listings</h2>
        <ul>
          <li>Add new</li>
          <li>Browse</li>
        </ul>
      </div>
      <div class='nav-menu' id='nav-menu-open-source'>
        <h2>Open source</h2>
        <ul>
          <li>Onii-Chan</li>
          <li>Derry LUG / BLUG</li>
          <li>Laravel</li>
        </ul>
      </div>
      <div class='nav-menu' id='nav-menu-northern-ireland'>
        <h2>Northern Ireland</h2>
        <ul>
          <li>InvestNI</li>
          <li>SyncNI</li>
          <li>Discover Northern Ireland</li>
        </ul>
      </div>
      <div class='nav-menu' id='nav-menu-general'>
        <h2>About + Supporters</h2>
        <ul>
          <li>Contact Us</li>
          <li>OpenNI</li>
          <li>Flax &amp; Teal Limited</li>
          <li>Sponsor 1</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</body>
</html>
