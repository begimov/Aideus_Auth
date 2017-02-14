{% extends 'mail/templates/default.php' %}

{% block content %}
  <p>You have signed up successfully.</p>
  <p>Please activate your account by using this link:</p>
  <p>{{ baseUrl }}{{ path_for('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}
