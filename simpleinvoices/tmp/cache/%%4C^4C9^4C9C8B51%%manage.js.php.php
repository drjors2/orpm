<?php /* Smarty version 2.6.18, created on 2016-10-28 08:59:53
         compiled from ../modules/custom_fields/manage.js.php */ ?>
<script type="text/javascript">

<?php echo '
/*
var view_tooltip ="'; ?>
<?php echo $this->_tpl_vars['LANG']['quick_view_tooltip']; ?>
 {1}<?php echo '";
var edit_tooltip = "'; ?>
<?php echo $this->_tpl_vars['LANG']['edit_view_tooltip']; ?>
 <?php echo $this->_tpl_vars['invoices']['preference']['pref_inv_wording']; ?>
 {1}<?php echo '";

		\'<!--0 Quick View --><a class="index_table" title="\'+  +\'\'+ view_tooltip +\'"  href="index.php?module=products&view=details&id={1}&action=view"> <img src="images/common/view.png" height="16" border="-5px" padding="-4px" valign="bottom" /></a>\',

		\'<!--1 Edit View --><a class="index_table" title="\'+  +\'\'+ edit_tooltip +\'"  href="index.php?module=products&view=details&id={1}&action=edit"><img src="images/common/edit.png" height="16" border="-5px" padding="-4px" valign="bottom" /><!-- print --></a>\',
*/

			var columns = 4;
			var padding = 12;
			var grid_width = $(\'.col\').width();
			
			grid_width = grid_width - (columns * padding);
			percentage_width = grid_width / 100; 
		
			
			$(\'#manageGrid\').flexigrid
			(
			{
			url: \'index.php?module=custom_fields&view=xml\',
			dataType: \'xml\',
			colModel : [
				{display: \''; ?>
<?php echo $this->_tpl_vars['LANG']['actions']; ?>
<?php echo '\', name : \'actions\', width : 10 * percentage_width, sortable : false, align: \'center\'},
				{display: \''; ?>
<?php echo $this->_tpl_vars['LANG']['id']; ?>
<?php echo '\', name : \'cf_id\', width : 10 * percentage_width, sortable : false, align: \'left\'},
				{display: \''; ?>
<?php echo $this->_tpl_vars['LANG']['custom_field']; ?>
<?php echo '\', name : \'cf_custom_field\', width : 40 * percentage_width, sortable : false, align: \'left\'},
				{display: \''; ?>
<?php echo $this->_tpl_vars['LANG']['custom_label']; ?>
<?php echo '\', name : \'cf_custom_label\', width : 40 * percentage_width, sortable : false, align: \'left\'}
				
				],
				

			sortname: \'cf_id\',
			sortorder: \'asc\',
			usepager: false,
			/*title: \'Manage Custom Fields\',*/
			pagestat: \''; ?>
<?php echo $this->_tpl_vars['LANG']['displaying_items']; ?>
<?php echo '\',
			procmsg: \''; ?>
<?php echo $this->_tpl_vars['LANG']['processing']; ?>
<?php echo '\',
			nomsg: \''; ?>
<?php echo $this->_tpl_vars['LANG']['no_items']; ?>
<?php echo '\',
			pagemsg: \''; ?>
<?php echo $this->_tpl_vars['LANG']['page']; ?>
<?php echo '\',
			ofmsg: \''; ?>
<?php echo $this->_tpl_vars['LANG']['of']; ?>
<?php echo '\',
			useRp: false,
			rp: 25,
			showToggleBtn: false,
			showTableToggleBtn: false,
			height: \'auto\'
			}
			);


'; ?>


</script>