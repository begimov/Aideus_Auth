{% extends 'templates/default.php' %}

{% block title %}Sign up{% endblock %}

{% block content %}
<h1>Sign up</h1>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('signup_post') }}" method="post" autocomplete="off">
      <div class="form-group">
          <label for="Email">Email address</label>
          <input type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="Username">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" class="form-control" name="password" iplaceholder="Password">
        </div>
        <div class="form-group">
          <label for="Password_confirm">Confirm password</label>
          <input type="password" class="form-control" name="password_confirm">
        </div>
        <input type="submit" class="btn btn-default" value="Sign up">
    </form>
  </div>
  <div class="col-md-6"></div>
</div>
{% endblock %}
