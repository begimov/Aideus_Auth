{% extends 'templates/default.php' %}

{% block title %}Password recovery{% endblock %}

{% block content %}
<div class="container">
<h1>Forgot your password?</h1>
<p>Enter your email address to reset your password. You may need to check your spam folder.</p>
<div class="row">
  <div class="col-md-6">
    <form action="{{  path_for('pass_recover_post') }}" method="post" autocomplete="off">
      <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="Email"{% if requestData['email'] %} value="{{ requestData['email'] }}" {% endif %}>
          {% if errors.has('email') %}
              <p class="text-danger">{{  errors.first('email') }}</p>
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
