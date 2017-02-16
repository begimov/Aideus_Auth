{% extends 'templates/default.php' %}

{% block title %}Community{% endblock %}
{% block css %}<link href="css/sub.css" rel="stylesheet">{% endblock %}

{% block content %}
  <div class="container">
    <div class="aideus-icon">
      <img src="" alt="" class="img-rounded" width="128px" height="128px">
    </div>
    <h1 class="aideus-title">Community</h1>
    <div class="row">
      <div class="col-md-6">
        <h2 class="aideus-left">Users:</h2>
        {% if users is empty %}
        <p class="aideus-desc">No users</p>
        {% else %}
          {% for u in users %}
            <p class="aideus-desc">
              {{ u.getName() }}<br>
              <a href="{{ path_for('user_profile', { 'username': u.username }) }}" class="text-primary">profile</a><br>
            </p>
          {% endfor %}
        {% endif %}
      </div>
      <div class="col-md-6"></div>
    </div>
  </div>
{% endblock %}
