{% extends 'templates/default.php' %}

{% block title %}Sign up{% endblock %}

{% block content %}
<div class="container">
<h1>Sign up</h1>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('signup_post') }}" method="post" autocomplete="off">
      <div class="form-group">
          <label for="Email">Email address</label>
          <input type="text" class="form-control" name="email" placeholder="Email"{% if requestData['email'] %} value="{{ requestData['email'] }}" {% endif %}>
          {% if errors.first('email') %}
              <p class="text-danger">{{  errors.first('email') }}</p>
          {% endif %}
        </div>
        <div class="form-group">
          <label for="Username">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username"{% if requestData['username'] %} value="{{ requestData['username'] }}" {% endif %}>
          {% if errors.first('username') %}
              <p class="text-danger">{{  errors.first('username') }}</p>
          {% endif %}
        </div>
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
          {% if errors.first('password') %}
              <p class="text-danger">{{  errors.first('password') }}</p>
          {% endif %}
        </div>
        <div class="form-group">
          <label for="Password_confirm">Confirm password</label>
          <input type="password" class="form-control" name="password_confirm">
          {% if errors.first('password_confirm') %}
              <p class="text-danger">{{  errors.first('password_confirm') }}</p>
          {% endif %}
        </div>
        <input type="submit" class="btn btn-default" value="Sign up">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
  </div>
  <div class="col-md-6"></div>
</div>
</div>
{% endblock %}
