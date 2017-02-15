{% extends 'templates/default.php' %}

{% block title %}Sign in{% endblock %}

{% block content %}
<div class="container">
<h1>Sign in</h1>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('signin_post') }}" method="post" autocomplete="off">
      <div class="form-group">
          <label for="identifier">Email / Username</label>
          <input type="text" class="form-control" name="identifier" placeholder="Email / Username"{% if requestData['identifier'] %} value="{{ requestData['identifier'] }}" {% endif %}>
          {% if errors.first('identifier') %}
              <p class="text-danger">{{  errors.first('identifier') }}</p>
          {% endif %}
        </div>
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
          {% if errors.first('password') %}
              <p class="text-danger">{{  errors.first('password') }}</p>
          {% endif %}
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="rememberme"> Remember me
          </label>
        </div>
        <input type="submit" class="btn btn-default" value="Sign in">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
  </div>
  <div class="col-md-6"></div>
</div>
</div>
{% endblock %}
