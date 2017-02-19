{% extends 'templates/default.php' %}

{% block title %}Password reset{% endblock %}

{% block content %}
<div class="container">
<h1>Change your password</h1>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('pass_reset_post') }}?email={{ email }}&recoverId={{ recoverId|url_encode }}" method="post" autocomplete="off">
      <div class="form-group">
        <label for="Password">New password</label>
        <input type="password" class="form-control" name="new_password" placeholder="Password">
        {% if errors.has('new_password') %}
            <p class="text-danger">{{  errors.first('new_password') }}</p>
        {% endif %}
      </div>
      <div class="form-group">
        <label for="Password_confirm">Confirm new password</label>
        <input type="password" class="form-control" name="password_confirm">
        {% if errors.has('password_confirm') %}
            <p class="text-danger">{{  errors.first('password_confirm') }}</p>
        {% endif %}
      </div>
      <input type="submit" class="btn btn-default" value="Submit">
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
  </div>
  <div class="col-md-6"></div>
</div>
</div>
{% endblock %}
