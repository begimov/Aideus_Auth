{% if flash %}
    <div class="alert alert-success" role="alert">{{ flash }}</div>
{% endif %}
{% if flashError %}
    <div class="alert alert-danger" role="alert">{{ flashError }}</div>
{% endif %}
