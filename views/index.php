<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
  </head>
  <body>
    <h1 style="text-align: left;">User Credentials</h1>
    <div style="font-size: 30px;font-weight:100;">
    <?php if (!empty($users)) :?>
        Username: <?= htmlspecialchars($users[0]['username'], ENT_QUOTES) ?><br />
        Password: <?= htmlspecialchars($users[0]['password'], ENT_QUOTES) ?><br />
    <?php endif?>
    </div>
  </body>
</html>
