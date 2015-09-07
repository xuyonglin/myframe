<?php 
xhprof_enable(); 
require(__DIR__ . '/../vendor/autoload.php');

$config = require(__DIR__ . '/../config/config.php');

(new run($config)) -> run();

$xhprof_data = xhprof_disable(); 
        $XHPROF_ROOT = "/Users/xuyonglin/xhprof-0.9.4";//这里填写的就是你的xhprof的路径  
        include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";  
        include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";
        $xhprof_runs = new XHProfRuns_Default();
        $run_id = $xhprof_runs->save_run($xhprof_data, "myframe"); 
        echo "---------------\n".  
"Assuming you have set up the http based UI for \n".  
"XHProf at some address, you can view run at \n".  
'<a target="_blank" href="http://localhost/xhprof/xhprof_html/index.php?run=' . $run_id . '&source=myframe">http://localhost/xhprof/xhprof_html/index.php?run=$run_id&source=yaobj</a>'.  
"---------------\n"; 