{% extends 'templates/default.php' %}

{% block title %}Update {{ user.getName() }} profile{% endblock %}

{% block content %}
<div class="container">
<h1>Update profile</h1>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('update_profile_post') }}" method="post" autocomplete="off">
      <div class="form-group">
          <label for="first_name">First name:</label>
          <input type="text" class="form-control" name="first_name" {% if auth.first_name %}value="{{ auth.first_name }}"{% else %}placeholder="First name"{% endif %}>
          {% if errors.has('first_name') %}
              <p class="text-danger">{{  errors.first('first_name') }}</p>
          {% endif %}
      </div>
      <div class="form-group">
          <label for="last_name">Last name:</label>
          <input type="text" class="form-control" name="last_name" {% if auth.last_name %}value="{{ auth.last_name }}"{% else %}placeholder="Last name"{% endif %}>
          {% if errors.has('last_name') %}
              <p class="text-danger">{{  errors.first('last_name') }}</p>
          {% endif %}
      </div>
      <input type="submit" class="btn btn-default" value="Update">
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
  </div>
  <div class="col-md-6"></div>
</div>
</div>
{% endblock %}
