<?php

use Mrangelovofficial\Diff\Diff;

require 'vendor/autoload.php';
$original = file_get_contents('compare/file1.txt');
$target = file_get_contents('compare/file2.txt');

$diffObject = new Diff($original,$target);
?>

<pre class="prettyprint diffPreview">
<?php  echo $diffObject->getDiff() ?>
</pre>

<style>
    .oldDiff {
        background-color: rgba(229,83,75,0.35);
    }

    .newDiff {
        background-color: rgba(70,149,74,0.35);
    }
    .defaultDiff {
        padding: 4px 0;
        margin: 0;
        line-height: 1;
    }
    .diffPreview br{
        display: none;
    }
    .diffPreview {
        border: 0 !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>