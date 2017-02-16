<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ path_for('home') }}">AIΔEUS</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ path_for('research') }}">Research</a></li>
        <li><a href="{{ path_for('community') }}">Community</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        {% if auth %}
          {% if auth.isAdmin() %}
            <li><a href="{{ path_for('admin') }}">Admin panel</a></li>
          {% endif %}
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ auth.getName() }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ path_for('user_profile', { 'username': auth.username }) }}">Profile</a></li>
              <li><a href="{{ path_for('settings') }}">Settings</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ path_for('signout') }}">Sign out</a></li>
            </ul>
          </li>
        {% else %}
            <li><a href="{{ path_for('signup') }}">Sign up</a></li>
            <li><a href="{{ path_for('signin') }}">Sign in</a></li>
        {% endif %}
      </ul>
    </div>
  </div>
</nav>
