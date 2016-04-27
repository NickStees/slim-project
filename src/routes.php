<?php
// Routes

$app->get('/form', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("json-pdo '/' route");

    $mapper = new FormsMapper($this->db);
    $forms = $mapper->getForms();

    $response->getBody()->write(json_encode($forms));
    return $response;
});

$app->get('/form/{form_id}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("jsonID-pdo '/' route");

    $mapper = new FormsMapper($this->db);
    $forms = $mapper->getFormById($args['form_id']);

    $response->getBody()->write($forms);
    return $response;
});

$app->post('/form/{form_id}', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("jsonID-pdo '/' route-post");
    $data = $request->getParam('data');

    $mapper = new FormsMapper($this->db);
    $forms = $mapper->addSubmission($args['form_id'], $data);

    $response->getBody()->write($forms);
    return $response;
});


$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.html', $args);
});
