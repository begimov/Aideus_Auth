{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}
{% block css %}<link href="css/home.css" rel="stylesheet">{% endblock %}

{% block content %}
  <div class="container">
        <h1 class="aideus-title">AIΔEUS</h1>
        <p class="lead">Our goal is creation of a strong artificial intelligence, solution of fundamental scientific problems, achievement of universality by embodied machine learning and decision-making systems.</p>
    <div class="row">
      <div class="col-md-5">
        <div class="aideus-icon">
          <img src="" alt="" class="img-rounded" width="128px" height="128px">
        </div>
        <h2 class="aideus-left">Research & Publications</h2>
        <p class="aideus-desc">Unlike other projects attempting to create a strong artificial intelligence on the basis of existing weak methods implementing some or other cognitive functions, we develop models of intelligent behavior, which are characterized by well-grounded universality, by increasing their practical applicability.</p>
        <p class="aideus-left"><a class="btn btn-default" href="{{ path_for('research') }}" role="button">Read publications</a></p>
      </div>
      <div class="col-md-7">
        <div class="aideus-icon">
          <img src="" alt="" class="img-rounded" width="128px" height="128px">
        </div>
        <h2 class="aideus-left">Community & Partners</h2>
        <p class="aideus-desc">The goal of our project is overcoming of restrictions of human thinking and solution of the most difficult and essential challenges and problems by creation of a strong artificial intelligence. We perfectly realize all complexity of the problem put by us and for this reason first of all we believe that it is necessary to ensure and support fundamental scientific research in this field.</p>
        <p class="aideus-desc">Now your help is necessary for our project. If you really are excited with idea of creation of strong artificial intelligence if you consider this goal noble and want to change life of people to the best, please contact us!</p>
        <p class="aideus-left"><a class="btn btn-default" href="{{ path_for('signup') }}" role="button">Contact us</a></p>
      </div>
    </div>
    <div class="footer">
      <div class="fb-like" data-href="http://www.facebook.com/pages/Aideus-Strong-artificial-intelligence/455322977847194" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>
    </div>
  </div>
{% endblock %}
