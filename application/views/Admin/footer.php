<div class="footer noPrint">
    <div class="footer-inner">
      <div class="footer-content">
        <span class="bigger-120">
             <span class="blue bolder">Car Wash</span>
             2020-2021
        </span>
       </div>
    </div>
</div>
<style>
.select2.narrow {
    width: 200px;
}
.wrap.select2-selection--single {
    height: 100%;
}
.select2-container .wrap.select2-selection--single .select2-selection__rendered {
    word-wrap: break-word;
    text-overflow: inherit;
    white-space: normal;
}
</style>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/angular.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery-ui.min.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery-ui.custom.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.ui.touch-punch.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.easypiechart.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.sparkline.index.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.flot.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.flot.pie.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.flot.resize.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery.dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/buttons.html5.min.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url();?>assests/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/buttons.colVis.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/moment.min.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url();?>assests/js/bootstrap-tag.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/ace-elements.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/ace.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/select2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assests/js/typeahead.js"></script>
<script type="text/javascript">
	$(".multiselectbox").select2({});
	$(".selectMaterialName").select2({});
	$(".allSubadminList").select2({
	  ajax: {
	      url: "<?php echo base_url();?>Subadmin/get_all_subadmins",
	      dataType: 'json',
	      delay: 250,
	      data: function (params) {
	          return {
	              q: params.term
	          };
	      },
	    results: function(data, page) {
	      return {
	        results: data
	      };
	    }
	  },
	  minimumInputLength: 1,
	  placeholder : "Select Subadmin"
	});
</script>
 <script type="text/javascript">
    $("#date_time").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
    $("#from_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
    $("#to_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#start_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#enddate").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#requestdate").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#purchase_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#receive_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#bill_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d",changeYear : true , yearRange : "1960:"+ new Date().getFullYear() });
		$("#payment_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#move_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#workorder_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#return_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
		$("#issue_date").datepicker({ dateFormat:'dd-mm-yy',maxDate: "+0d" });
</script>

</body>
</html>		