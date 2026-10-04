<?php

$app->get("/auth/register", [$authController, "showRegister"]);
$app->post("/auth/register", [$authController, "register"]);
$app->get("/auth/login", [$authController, "showLogin"]);
$app->post("/auth/login", [$authController, "login"]);
$app->get("/auth/logout", [$authController, "logout"]);
