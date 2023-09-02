<?php
$ip = $_POST["ip"] ?? NULL;
$page = $_SERVER['REQUEST_URI'] ?? NULL; // 현재페이지 주소 그대로 받음

if (!empty($ip)) {
    $result = shell_exec("ping -c 5 {$ip}");
    $result = iconv("UTF-8", "UTF-8", $result);
    $result = str_replace("\n", "<br>", $result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ping Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Ping Test</h1>
    <hr>
    <form action="<?php echo $page; ?>" method="POST">
        <div class="mb-3">
            <label for="ip" class="form-label">Ping</label>
            <input type="text" class="form-control" id="ip" name="ip" placeholder="ex) 192.168.0.100">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Check</button>
        </div>
    </form>
    <?php if (!empty($result)) { ?>
        <hr>
        <div>
            <h4>Ping Result:</h4>
            <?php echo $result; ?>
        </div>
    <?php } ?>
</div>
</body>
</html>
