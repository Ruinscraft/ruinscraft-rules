<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script defer src="/main.js"></script>
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

                echo "<h2>" . $_category['title'] . "</h2>";

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

                    echo "
                        <button type=\"button\" class=\"collapsible\">" . $rule['rule'] . "</button>
                        <div class=\"content\">
                            <p>" . $rule['reason'] . "</p>
                        </div>
                    ";
                }
            }
          ?>
    </body>
</html>
