<div data-collapse="medium" data-animation="over-right" data-duration="400" class="dashboard-nav w-nav">
  <div class="w-container"><a href="old-home.html" class="w-nav-brand"><img src="images/jvtock-logo.png" width="70" alt=""></a>
    <nav role="navigation" class="open-menue-bg w-nav-menu">
      <a href="/inventory" class="nav-links w-nav-link">Iterms of Interest</a>
      <a href="/action_items" class="nav-links w-nav-link">Action Items</a>
      <a href="item-inquiry-notification.html" class="nav-links w-nav-link">Item Notification</a>
      <a class="nav-links w-nav-link" href="/logout"> Logout </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </nav>
    <div class="w-nav-button">
      <div class="w-icon-nav-menu"></div>
    </div>
  </div>
</div>
