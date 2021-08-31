<?php

/**
*		Este arquivo tem como objetivo utilizar o Javascript + PHP;
*/



$title = 'Hello World';

?>

<script language="javascript">
    var title = "<?php print $title ?>";
    alert(title);
</script>