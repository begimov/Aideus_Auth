{% extends 'mail/templates/default.php' %}

{% block content %}
  <p>Someone requested a password change for your account. If it was you, you can set new password here:</p>
  <p>{{ baseUrl }}{{ path_for('pass_reset') }}?email={{ user.email }}&recoverId={{ recoverId|url_encode }}</p>
  <p>If you dont want to change your password, ignore this message.
{% endblock %}
