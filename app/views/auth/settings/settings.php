{% extends 'templates/default.php' %}

{% block title %}Settings{% endblock %}

{% block content %}
<div class="container">
<h1>Change password</h1>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('settings_post') }}" method="post" autocomplete="off">
        <div class="form-group">
          <label for="Current_password">Current password</label>
          <input type="password" class="form-control" name="current_password" placeholder="Password">
          {% if errors.has('current_password') %}
              <p class="text-danger">{{  errors.first('current_password') }}</p>
          {% endif %}
        </div>
        <div class="form-group">
          <label for="New_password">New password</label>
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
        <input type="submit" class="btn btn-default" value="Change password">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
  </div>
  <div class="col-md-6"></div>
</div>
</div>
{% endblock %}
