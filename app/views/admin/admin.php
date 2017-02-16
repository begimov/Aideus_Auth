{% extends 'templates/default.php' %}

{% block title %}Admin panel{% endblock %}
{% block css %}<link href="css/sub.css" rel="stylesheet">{% endblock %}

{% block content %}
<div class="container">
  <div class="aideus-icon">
    <img src="" alt="" class="img-rounded" width="128px" height="128px">
  </div>
  <h1 class="aideus-title">Admin panel</h1>
  <div class="row">
    <div class="col-md-6">
      <h2 class="aideus-left">Add publication:</h2>
      <p class="aideus-desc">
        ...
      </p>
    </div>
    <div class="col-md-6">
      <h2 class="aideus-left">Manage users:</h2>
      <p class="aideus-desc">...</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h2 class="aideus-left">Title</h2>
      <p class="aideus-desc">...</p>
    </div>
  </div>
</div>
{% endblock %}
