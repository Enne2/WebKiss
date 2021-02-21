<?php
require_once 'lib/Compiler.php';
require_once 'lib/Template.php';
require_once 'lib/Parsedown.php';

$template_path  = 'templates/';
$data_path = 'data/';
$script_path = 'scripts/';

$compiler = new Compiler();
#file_put_contents("public/index.html", Template::view($template_path.'index.html', Compiler::compile($data_path."index.yaml"), $script_path."index.php"));
$compiler->add_step("Home", 'public/index.html', $template_path.'index.html', $data_path."index.yaml",$script_path."index.php");
$compiler->compile();
echo "Compilation terminated\n";