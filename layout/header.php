<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/db.php"); ?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Blog | RiftCore.de</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/layout/styles/custom.css">
    <link rel="stylesheet" href="/layout/styles/ckeditor.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/styles/github-dark.min.css"> -->
</head>

<body>

<?php
    $blogAPI = $_SERVER['DOCUMENT_ROOT'] . '/json/blog.json';
    require_once($_SERVER['DOCUMENT_ROOT'] . '/api.php');

    require_once($_SERVER['DOCUMENT_ROOT'] . '/layout/navbar.php');
?>

<main class="main-with-sidebar f-4">
<div class="container-fluid ps-4">