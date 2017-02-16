{% extends 'templates/default.php' %}

{% block title %}Research{% endblock %}
{% block css %}<link href="css/sub.css" rel="stylesheet">{% endblock %}

{% block content %}
  <div class="container">
    <div class="aideus-icon">
      <img src="" alt="" class="img-rounded" width="128px" height="128px">
    </div>
    <h1 class="aideus-title">Research</h1>
    <div class="row">
      <div class="col-md-6">
        <h2 class="aideus-left">What makes us different?</h2>
        <p class="aideus-desc">Unlike other projects attempting to create a strong artificial intelligence on the basis of existing weak methods implementing some or other cognitive functions, we develop models of intelligent behavior, which are characterized by well-grounded universality, by increasing their practical applicability.</p>
      </div>
      <div class="col-md-6">
        <h2 class="aideus-left">Our approach.</h2>
        <p class="aideus-desc">We proceed from universal prediction models on the basis of algorithmic probability used for choosing optimal actions, developing cognitive architecture elements as heuristics, essentially improving the efficiency of the models for functioning in our world without violating their universality.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2 class="aideus-left">Unresolved problems.</h2>
        <p class="aideus-desc">Detailed analysis and implementation of cognitive functions within the universal algorithmic intelligence for achievement of possibility of its practical implementation are far from complete. The basic unresolved problem (which also hasn't been resolved in other approaches, and frequently is simply ignored) remains organization of work in algorithmically complete space of models and solutions without exhaustive search.</p>
      </div>
    </div>
    <div class="aideus-icon">
      <img src="" alt="" class="img-rounded" width="128px" height="128px">
    </div>
    <h2 class="aideus-title">Publications</h2>
    <div class="row">
      <div class="col-md-6">
        <h2 class="aideus-left">Publications on AGI.</h2>
        {% for p in agiPbl %}
          <p class="aideus-desc">
            {{ p.getAuthors() }}<br>
            "{{ p.getTitle() }}".<br>
            {{ p.getPublicationPlace() }}<br>
            {% if p.getPdfLink() %}
              <a href="{{ p.getPdfLink() }}" class="text-primary">Download PDF</a><br>
            {% endif %}
            {% if p.getWebLink() %}
              <a href="{{ p.getWebLink() }}" class="text-primary">View</a><br>
            {% endif %}
          </p>
        {% endfor %}
      </div>
      <div class="col-md-6">
        <h2 class="aideus-left">Previous publications.</h2>
        {% for p in prevPbl %}
          <p class="aideus-desc">
            {{ p.getAuthors() }}<br>
            "{{ p.getTitle() }}".<br>
            {{ p.getPublicationPlace() }}<br>
            {% if p.getPdfLink() %}
              <a href="{{ p.getPdfLink() }}" class="text-primary">Download PDF</a><br>
            {% endif %}
            {% if p.getWebLink() %}
              <a href="{{ p.getWebLink() }}" class="text-primary">View</a><br>
            {% endif %}
          </p>
        {% endfor %}
        </p>
      </div>
    </div>
  </div>
{% endblock %}
