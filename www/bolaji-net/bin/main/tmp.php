<script type="text/javascript">
 var _cc = '<?=$_REQUEST['cc']?>';
 var _sid = '<?= (isset($_REQUEST['vid']) && !empty($_REQUEST['vid'])) ? $_REQUEST['vid'] : $_REQUEST['sid']?>';
 var _aid = '<?=$_REQUEST['aid']?>';
</script>
<?php if(isset($_REQUEST['vid']) && !empty($_REQUEST['vid'])) { ?>
<script type="text/javascript" src="/script/flvplayer.js"></script>
<?php } else { ?>
<script type="text/javascript" src="/script/soundmanager2.js"></script>
<?php }  ?>
<script type="text/javascript">
 soundManager.debugMode = true;
 soundManager.onload = function() {
 }
</script>
<link rel="stylesheet" type="text/css" href="/style/player.css" title="dark" media="screen" />
