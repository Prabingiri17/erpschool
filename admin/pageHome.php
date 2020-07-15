<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['membership management homepage'];
	include("{$currDir}/incHeader.php");
?>

<?php
	if(!sqlValue("select count(1) from membership_groups where allowSignup=1")){
		$noSignup=TRUE;
		?>
		<div class="alert alert-info">
			<i><?php echo $Translation["attention"]; ?></i>
			<br><?php echo $Translation["visitor sign up"]; ?>
			</div>
		<?php
	}
?>


<?php
	// get the count of records having no owners in each table
	$arrTables=getTableList();

	foreach($arrTables as $tn=>$tc){
		$countOwned=sqlValue("select count(1) from membership_userrecords where tableName='$tn' and not isnull(groupID)");
		$countAll=sqlValue("select count(1) from `$tn`");

		if($countAll>$countOwned){
			?>
			<div class="alert alert-info">
				<?php echo $Translation["table data without owner"]; ?>
				</div>
			<?php
			break;
		}
	}
?>
<!--
<div class="page-header"><h1><?php echo $Translation['membership management homepage']; ?></h1></div>

<?php if(!$adminConfig['hide_twitter_feed']){ ?>
	<div class="row" id="outer-row"><div class="col-md-8">
<?php } ?>

<div class="row" id="inner-row">
-->

<!-- ################# Maintenance mode ###################### -->
<!--<?php
	if(maintenance_mode()){
		$off_classes = 'btn-default locked_inactive';
		$on_classes = 'btn-danger unlocked_active';
	}else{
		$off_classes = 'btn-success locked_active';
		$on_classes = 'btn-default unlocked_inactive';
	}
?>
<div class="col-md-12 text-right vspacer-lg">
	<label><?php echo $Translation['maintenance mode']; ?></label>
	<div class="btn-group" id="toggle_maintenance_mode">
		<button type="button" class="btn <?php echo $off_classes; ?>"><?php echo $Translation['OFF']; ?></button>
		<button type="button" class="btn <?php echo $on_classes; ?>"><?php echo $Translation['ON']; ?></button>
	</div>
</div>
<script>
	$j('#toggle_maintenance_mode button').click(function(){
		if($j(this).hasClass('locked_active') || $j(this).hasClass('unlocked_inactive')){
			if(confirm('<?php echo html_attr($Translation['enable maintenance mode?']); ?>')){
				$j.ajax({
					url: 'ajax-maintenance-mode.php?status=on', 
					complete: function(){
						location.reload();
					}
				});
			}
		}else{
			if(confirm('<?php echo html_attr($Translation['disable maintenance mode?']); ?>')){
				$j.ajax({
					url: 'ajax-maintenance-mode.php?status=off', 
					complete: function(){
						location.reload();
					}
				});
			}
		}
	});
</script>
-->

<script>
	$j(function(){
		$j(window).resize(function(){
			$j('.remaining-width').each(function(){
				var panel_width = $j(this).parents('.panel-body').width();
				var other_cell_width = $j(this).prev().width();

				$j(this).attr('style', 'max-width: ' + (panel_width * .9 - other_cell_width) + 'px !important;');
			});
		}).resize();
	})
</script>


<?php
	include("{$currDir}/incFooter.php");
?>

