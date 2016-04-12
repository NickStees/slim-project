<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.html', $args);
});

$app->get('/json/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("json-pdo '/' route");

    $mapper = new MessagesMapper($this->db);
    $messages = $mapper->getMessages();

    $response->getBody()->write(var_export($messages, true));
    return $response;
});
