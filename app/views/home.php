{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}
{% block css %}<link href="css/cover.css" rel="stylesheet">{% endblock %}

{% block content %}
    <div class="cover-container">
      <div class="inner cover">
        <h1 class="cover-heading">Cover your page.</h1>
        <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
        <p class="lead">
          <a href="#" class="btn btn-lg btn-default">Learn more</a>
        </p>
      </div>
    </div>
<!-- <h1>User List</h1>
<ul>
    <li><a href="{{ path_for('home', { 'name': name }) }}">{{ name }}</a></li>
</ul> -->
{% endblock %}
