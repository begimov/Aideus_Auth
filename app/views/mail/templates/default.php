{% if auth %}
  <p>Hello, {{ auth.getName }}.</p>
{% else %}
  <p>Hello.</p>
{% endif %}

{% block content %}{% endblock %}
