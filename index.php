<?php

use Mrangelovofficial\Diff\Diff;

require 'vendor/autoload.php';
$original = file_get_contents('compare/file1.txt');
$target = file_get_contents('compare/file2.txt');

$diffObject = new Diff($original,$target);


?>

<pre class="prettyprint">
<?php  echo $diffObject->getOriginalString() ?>
</pre>

<style>
    pre {
        /* width: 50%; */
        /* overflow: hidden; */
    }
</style>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>