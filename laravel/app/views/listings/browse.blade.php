<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>OpenNI Index :: Open source business listings for Northern Ireland</title>
  <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'>
  {{ HTML::style('css/chunk-five.css') }}
  {{ HTML::style('css/league-gothic.css') }}
  {{ HTML::style('css/main.css') }}
  {{ HTML::style('css/top-menu.css') }}
  {{ HTML::style('css/search-banner.css') }}
  {{ HTML::style('css/filters.css') }}
  {{ HTML::style('css/content.css') }}
  {{ HTML::style('css/individual-company.css') }}
  {{ HTML::style('css/listings.css') }}
  {{ HTML::style('css/footer.css') }}
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src='/js/browse.js'></script>
</head>
<body>
<div id='background-container'>
</div>
<div class='filter-menu' id='filters-left'>
  <div id='filter-sections'>
    <h1>&rarr;sections</h1>
    <ul>
      <li class='plus-1'>--all--</li>
      <li class='plus-2'>App Development</li>
      <li class='plus-3'>Arts &amp; Humanities</li>
      <li class='selected plus-4'>Enterprise Solns</li>
      <li class='plus-5'>Statistics &amp; Econ.</li>
      <li class='plus-4'>Science, Eng. &amp; Tech</li>
      <li class='plus-3'>Support Services</li>
      <li class='plus-2'>Web Technologies</li>
    </ul>
  </div>
  <div id='filter-filters'>
    <h1>&rarr;filters</h1>
    <div id='filter-endorsements'>
      <label>Endorsements</label>
      <table>
        <tr>
          <td>&gt;0</td><td class='selected'>&gt;1</td><td>&gt;2</td>
        </tr>
      </table>
    </div>
    <div id='filter-structure'>
      <label>Structure</label>
      <table>
        <tr>
          <td>Sole</td><td>Ltd.</td><td>Ltd.&gt;10</td>
        </tr>
      </table>
    </div>
    <div id='filter-structure'>
      <label>Listing Age</label>
      <table>
        <tr>
          <td class="selected">Include recent additions</td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div class='filter-menu' id='filters-right'>
  <div id='filter-tags'>
    <h1>tags&larr;</h1>
    <div id='tag-search-box'>
      <input type='text' name='tag-search-box-input'/><p><strong>Tag</strong> Search...</p>
    </div>
    <ul>
      <li class='selected'>Python</li>
      <li class='selected'>C++</li>
      <li>PHP</li>
      <li>Webdev</li>
      <li>Laravel</li>
      <li>New Zealand</li>
    </ul>
    <script src="js/tagcanvas.js" type="text/javascript"></script>
    <div id='filter-tag-canvas-1'>
      <div id="myCanvasContainer">
         <canvas width="150" height="150" id="myCanvas">
             <p>This browser does not support the canvas element</p>
             <ul>
                <li><a style="font-size: 30px" href="/">Java</a></li>
                <li><a style="font-size: 30px" href="/">LibreOffice</a></li>
                <li><a style="font-size: 30px" href="/">Linux</a></li>
                <li><a style="font-size: 20px" href="/">ASP</a></li>
                <li><a style="font-size: 30px" href="/">Email</a></li>
                <li><a style="font-size: 20px" href="/">OpenOffice</a></li>
             </ul>
         </canvas>
      </div>
    </div>
    <div id='filter-tag-canvas-2'>
      <div id="myCanvasContainer2">
         <canvas width="150" height="150" id="myCanvas2">
             <p>This browser does not support the canvas element</p>
             <ul>
                <li><a style="font-size: 40px" href="/">Fortran</a></li>
                <li><a style="font-size: 30px" href="/">Ruby</a></li>
                <li><a style="font-size: 30px" href="/">VPS</a></li>
                <li><a style="font-size: 50px" href="/">JS</a></li>
                <li><a style="font-size: 20px" href="/">Sysadmin</a></li>
                <li><a style="font-size: 30px" href="/">Joomla</a></li>
                <li><a style="font-size: 20px" href="/">MySQL</a></li>
             </ul>
         </canvas>
      </div>
    </div>
  </div>
</div>
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
            <p>Please enter some search terms...</p>
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
        <div id='company-container'>
          <p>Please select a company on the left...</p>
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
