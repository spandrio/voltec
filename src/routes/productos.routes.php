<?php

$app->get("/entidad", [$productosController, "index"]);
$app->get("/entidad/create", [$productosController, "create"])->add(authMiddleware(...));
$app->get("/entidad/update/{id}", [$productosController, "edit"])->add(authMiddleware(...));
$app->get("/entidad/{id}", [$productosController, "show"]);
$app->post("/entidad", [$productosController, "store"])->add(authMiddleware(...));
$app->put("/entidad/{id}", [$productosController, "update"])->add(authMiddleware(...));
$app->delete("/entidad/{id}", [$productosController, "destroy"])->add(authMiddleware(...));
