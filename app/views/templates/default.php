<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>AIDEUS | {% block title %}{% endblock %}</title>
    </head>
    <body>
        {% include 'templates/partials/messages.php' %}
        {% include 'templates/partials/navigation.php' %}
        {% block content %}{% endblock %}
    </body>
</html>
