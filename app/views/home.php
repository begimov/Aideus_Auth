{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}

{% block content %}
<h1>User List</h1>
<ul>
    <li><a href="{{ path_for('profile', { 'name': name }) }}">{{ name }}</a></li>
</ul>
{% endblock %}
