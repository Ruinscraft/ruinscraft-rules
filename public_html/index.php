<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
    <title>Ruinscraft Rules</title>
</head>
    <body>
          <?php

            $service = $_GET["service"];

            if ($service === NULL) {
                echo "<h2>No service specified</h2>";
                return;
            }

            $serviceDir = "./rules/" . $service . "/";

            foreach (scandir($serviceDir) as $ruleDir) {
                if ($ruleDir[0] == '.') {
                    continue;
                }

                if (!is_dir($serviceDir . $ruleDir)) {
                    continue;
                }

                $_categoryFile = $serviceDir . $ruleDir . "/_category.json";

                if (!file_exists($_categoryFile)) {
                    continue;
                }

                $_category = json_decode(file_get_contents($_categoryFile), true);

                echo "<h1>" . $_category['title'] . "</h1>";

                foreach (scandir($serviceDir . $ruleDir) as $ruleFile) {
                    if ($ruleFile[0] == '.') {
                        continue;
                    }

                    if (!is_file($serviceDir . $ruleDir . "/" . $ruleFile)) {
                        continue;
                    }

                    if ($ruleFile == "_category.json") {
                        continue;
                    }

                    $rule = json_decode(file_get_contents($serviceDir . $ruleDir . "/" . $ruleFile), true);

                    echo
                    "
                    <div class=\"rule\">
                        <p class=\"rule-header\"> " . $rule['rule'] . " </p>
                        <p class=\"rule-content\"> " . $rule['reason'] . " </p>
                    </div>
                    ";
                }
            }
          ?>
    </body>
</html>
