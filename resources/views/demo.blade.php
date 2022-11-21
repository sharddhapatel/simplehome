<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"></head>
<body>
<div class="main-containor">
<div class="col-md-6">
<div class="form-group">
<div class="class1" >
<span class="edit-pencil-open"><span id="first-name-lab">MIss Rupapar</span>&nbsp;&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
</div>
<div class="class2"  style="display: none;">
<div style="display: flex;">
<input type="text" class="form-control" style="width: 70%;" name="first_name" id="first-name" value="MIss Rupapar" placeholder="First Name">

<span class="btn btn-success edit-pencil-save" onclick="updateUser(this,'first_name','first-name','first-name-lab')"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
<span class="btn btn-danger edit-pencil-close"><i class="fa fa-times" aria-hidden="true"></i></span>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<div class="class1" >
<span class="edit-pencil-open"><span id="first-name-lab">sdfdsgdfgfdg</span>&nbsp;&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
</div>
<div class="class2"  style="display: none;">
<div style="display: flex;">
<input type="text" class="form-control" style="width: 70%;" name="first_name" id="first-name" value="sdfdsgdfgfdg" placeholder="First Name">

<span class="btn btn-success edit-pencil-save" onclick="updateUser(this,'first_name','first-name','first-name-lab')"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
<span class="btn btn-danger edit-pencil-close"><i class="fa fa-times" aria-hidden="true"></i></span>
</div>
</div>
</div></div>
</div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
// function showEdit(editableObj) {
// $(editableObj).css("background", "#FFF");
// }

// function saveToDatabase(editableObj, column, id) {
// $(editableObj)
// .css("background", "#FFF url(./images/loaderIcon.gif) no-repeat center right 5px");
// var edit = editableObj.innerHTML;
// $.ajax({
// url : "./save-edit.php",
// type : "POST",
// data : {column: column,
// editval: edit,
// id: id},
// success : function(data) {
// //alert(data);
// $(editableObj).css("background", "#FDFDFD");
// }
// });
// }

$(document).on("click",".edit-pencil-open",function(){
  $(".class1").css('display','block');
  $(".class2").css('display','none');
$(this).parent().parent().children('.class2').css('display','block');
$(this).parent().css('display','none');

})

$(document).on("click",".edit-pencil-close",function(){
$(this).parent().parent().parent().children('.class1').css('display','block');
$(this).parent().parent().css('display','none');

})

</script>