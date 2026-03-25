<style>
a.close {
top: 105px;
right: 36px;
}
.panel {
    border: 1px solid #dcdcdc;
    margin-bottom: 20px;
    box-shadow: none;
    background-color: #ffffff;
    background: #ffffff none repeat scroll 0% 0% !important;
    border: 1px solid #eaeaea !important;
}
.panel-heading {
    border: none !important;
    padding: 10px 20px;
    background: #2477c9;
}
.panel-info > .panel-heading {
    background-color: rgb(36, 119, 201);
    color: #fff !important;
}
</style>	<!-- DataTables -->


<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
<style type="text/css">
.uppercase{	text-transform: uppercase; }
.panel .panel-body {
border: 1px solid rgba(69, 176, 226, 0.75);
}
.panel.panel-info {
border: none;
}
#myImg {
border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
}

/* Caption of Modal Image */
#caption {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
text-align: center;
color: #ccc;
padding: 10px 0;
height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
-webkit-animation-name: zoom;
-webkit-animation-duration: 0.6s;
animation-name: zoom;
animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
from {-webkit-transform:scale(0)} 
to {-webkit-transform:scale(1)}
}

@keyframes zoom {
from {transform:scale(0)} 
to {transform:scale(1)}
}

/* The Close Button */
.close {
position: absolute;
*top: 15px;
*right: 35px;
top: 89px;
right: 293px;
color: #f1f1f1;
font-size: 40px;
font-weight: bold;
transition: 0.3s;
}

.close:hover,
.close:focus {
color: #bbb;
text-decoration: none;
cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
.modal-content {
width: 100%;
}
}
</style>


<div class="content-page">
<div class="content">
<div class="container">
<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert btn-info alert-micro btn-rounded pastel light dark" >
<a href="#" class="close" data-dismiss="alert">&times;</a>
<?php print_r($msg); ?>
</div>
<?php } ?>

<?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert alert-micro btn-rounded alert-danger">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<?php print_r($msg); ?>
</div>
<?php } ?>

<!-- end col -->
<div class="row">
<div class="col-sm-12">
<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
<header class="panel-heading" style="color:rgb(255, 255, 255)">
<i class="fa fa-refresh"></i> Year End Reset Software
</header>

<div class="card-box">
<div class="row">
<form class="form-horizontal"  method="post" action="<?php echo base_url();?>preference/resetTables" onsubmit="return resetSw()">
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="sales">Sales Reports</label></div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="purchase">Purchase Reports</label></div>
</div>
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="item">Item Reports</label></div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="party">Party Reports&nbsp;</label></div>
</div>
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="voucher">Voucher Reports&nbsp;</label></div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="expenses">Expenses Reports</label></div>
</div>
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="quotation">Quotation Reports&nbsp;</label></div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="dc">DC Reports&nbsp;</label></div>
</div>
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="inward">Inward Reports</label></div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="cashBill">Cash Bill Reports</label></div>
</div>
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-3"><label class="checkbox-inline"><input type="checkbox" name="resetChkBox[]"  value="full">Full Reset</label></div>
<div class="col-md-3">&nbsp;</div>
</div>
<div class="clearfix">&nbsp;</div>
<div class="col-sm-offset-5">
<button  class="btn btn-info" id="submit" type="submit"><i class="fa fa-refresh"></i> Year End Reset Software</button>
</div>
</form>
</div>
</div>
</section>
</div>
</div>

</div>
</div>


<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script>
var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/detect.js"></script>
<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<!-- Datatables-->
<!--<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>-->
<!-- App js -->
<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>  
<!--<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/dropify.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
$("input").keyup(function(){
$(this).parent().removeClass('has-error');
$(this).next().empty();
});
$('form').parsley();
})

$('input#defaultconfig').maxlength()

$('.form-control').maxlength({
alwaysShow: true,
warningClass: "label label-success",
limitReachedClass: "label label-danger",
separator: ' out of ',
preText: 'You typed ',
postText: '&nbsp;&nbsp;&nbsp;chars available.',
validate: true
});

$('.form-control').maxlength({
alwaysShow: true,
warningClass: "label label-success",
limitReachedClass: "label label-danger"
});

</script>

<script type="text/javascript">
//   //number..........................
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}

</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
modal.style.display = "block";
modalImg.src = this.src;
captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementById("close1");

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
modal.style.display = "none";
}

//Company Logo
// Get the modal
var modal = document.getElementById('myModalCmp');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImgCmp');
var modalImg = document.getElementById("img01Cmp");
var captionText = document.getElementById("captionCmp");
img.onclick = function(){
modal.style.display = "block";
modalImg.src = this.src;
captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementById("closeCmp");

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
modal.style.display = "none";
}
function resetFun()
{
if(confirm("Are you sure want to reset the bill numbers?"))
{
window.location.href='<?php echo base_url().'preference/resetFun';?>';
}
}
function resetSw()
{
if(confirm("Are you sure want to reset the software?"))
{
var checked=false;
var elements = document.getElementsByName("resetChkBox[]");
for(var i=0; i < elements.length; i++){
if(elements[i].checked) {
checked = true;
}
}
if (!checked) {
alert('Please select atleast one checkbox!');
return checked;
}
}
else
{
return false;
}	


}

$('.add').click(function(){

var tbody=$('#append');
$('<div class="form-group"><label class="control-label col-md-3">Card</label><div class="col-md-4"><input type="text" class="form-control" name="card[]" ></div></div>').appendTo(tbody);

});


</script>