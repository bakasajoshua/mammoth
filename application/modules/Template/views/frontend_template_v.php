<!DOCTYPE html>
<html>
<head>
    <title>EQA</title>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Muli|Open+Sans|Poiret+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?= @$page_css; ?>
</head>
<body>
    <?= $this->load->view($partial, $partialData); ?>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?= @$page_js; ?>
</body>
</html>