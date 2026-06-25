<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RoutineFlow — Your personal student routine organizer">
    <title>RoutineFlow<?= isset($page_title) ? ' — ' . htmlspecialchars($page_title) : '' ?></title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- App Stylesheet -->
    <link rel="stylesheet" href="/serverside/assets/css/style.css">
</head>
<body>
    <!-- Toast notification container -->
    <div id="toast-container" class="toast-container"></div>
