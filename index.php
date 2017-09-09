<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Category Tree</title>

<!-- Bootstrap -->
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/JavaScript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/JavaScript"
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8"
	src="js/treeMin.js"></script>

<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />


<style type="text/css">
.node-treeview {
	color: yellow;
	background-color: purple;
}

.node-treeview:not (.node-disabled ):hover {
	background-color: orange;
}

.inputBox {
	color: purple;
	background-color: orange;
}

body{
	background-color: pink;
}

.btnArea{

	padding-left: 40px;
	padding-bottom: 30px;
	padding-top: 40px;
	background-color: black;
}

.
.middle{
	
	padding-top: 10px;
	position-top: 300px;

}

.heading{

	padding-top: 30px;
	position-top: 120px;	
}
</style>
<script>


 $( function() {
    
  } );
 
 $( "#grpId" ).disableSelection();
	$(document).ready(function() {
		loadTreeData();
		
		
	});

	function loadTreeData() {
		$.ajax({
			url : "fetch.php",
			method : "POST",
			dataType : "json",
			success : function(data) {
				$('#treeview').treeview({
					data : data
				});
			}
		});
	setTimeout(function(){
    collapseAll();
    $( "#sortable" ).sortable();
}, 1500);
	}
	var counter = 15;
	var curRef = document.getElementById("btnRoot");
	function runScript(sel, e) {
		if (e.keyCode == 13) {
			
			var selEle = $("li[class*='node-selected'")[0];
			var text= selEle.innerText;
			var textVal = document.getElementById('editText').value;
			selEle.innerText = textVal;
			editNode(text,textVal);
			location.reload();
			
			

		}
	}

	function addScript(sel, e) {
		if (e.keyCode == 13) {
			var selEle = $("li[class*='node-selected'")[0];
			var parent= selEle.innerText;
			var child = document.getElementById('childVal').value;
			addChildNode(parent,child);
			
			
		}
	}

	function addChildNode(parent,child){
		//alert(parent+child);
		$.ajax({
			url : "addChild.php",
			method : "POST",
			data :  "name=" + parent + "&children=" + child,
			success: function(data){
                 if(data=="YES"){
                  //  alert("Sucs");
                 }else{
                   //     alert("can't Edit Node");
                 }
             }
		});
		location.reload();
		
	}
	function click_li(a) {

		$(a).toggleClass('glyphicon-folder-open', 'glyphicon-folder-close');

		if (a.className.indexOf("active ") == -1) {
			a.className = "active " + a.className;
			if (curRef != null) {
				curRef.className = curRef.className.replace("active", "");
				curRef = a;
			} else {
				curRef = a;
			}
		}
	};

	$(function() {
		

		$(".btn-primary").click(function() {
			$(".collapse").collapse('toggle');
		});

		$("#btnRoot").click(function() {
			$( "#sortable" ).sortable();
			document.getElementById("inputBox").removeAttribute("hidden");
			document.getElementById("textInput").focus();

		});

		$("#btnRefresh").click(function() {
			loadTreeData();
			$( "#sortable" ).sortable();

		});

		$("#btnChild")
				.click(
						function() {
							$( "#sortable" ).sortable();
							var list = $("li[class*='node-selected']")[0];
							var text=list.innerText;
							var listNode = document.createElement("input");
						
							listNode
									.setAttribute(
											'id',
											'childVal');
							listNode
									.setAttribute(
											'class',
											'input-lg inputBox');				
							
							listNode.setAttribute('onkeypress', 'return addScript(this,event)');
							var textnode = document.createTextNode("");
							listNode.appendChild(textnode);
							
							list.insertAdjacentElement("afterend", listNode);
							listNode.focus();

				
						});

		$("#btnEdit").click(function() {
			$( "#sortable" ).sortable();
			var selEle = $("li[class*='node-selected']")[0];
			var text = selEle.innerText;
			var node = document.createElement("input");
			node.setAttribute('onkeypress', 'return runScript(this,event)');
			node.setAttribute('id', 'editText');
			node.setAttribute('class', 'inputBox');
			var textnode = document.createTextNode(text);
			node.appendChild(textnode);
			selEle.appendChild(node);
			node.focus();


		});

		
		$("#btnDelete").click(function() {
			$( "#sortable" ).sortable();
			var element = $("li[class*='node-selected']")[0];
			var text = element.innerText;
			//alert(text);
			deleteNode(text);
			element.remove();
			location.reload();
		
			
			
		});

		$("#expand").click(function() {
			expandAll();
		});

		$("#collapse").click(function() {
			collapseAll();
		});

		$("#submit")
				.click(
						function() {
							$( "#sortable" ).sortable();
							var text = document.getElementById("textInput").value;
							insert(text, 0);
							document.getElementById("inputBox").setAttribute(
									"hidden", "hidden");
							location.reload();
							collapseAll();
							
						});

	});

	function deleteNode(text){
		//alert(text);
		$.ajax({
			url : "del.php",
			method : "POST",
			data :  "name=" + text,
			success: function(data){
                 if(data=="YES"){
                   // alert("Sucs");
                 }else{
                    //    alert("can't delete the row")
                 }
             }
		});
	}

	function editNode(text,replace){
		
		$.ajax({
			url : "edit.php",
			method : "POST",
			data :  "name=" + text + "&replace=" + replace,
			success: function(data){
                 if(data=="YES"){
                 //   alert("Sucs");
                 }else{
                   //     alert("can't Edit Node");
                 }
             }
		});
	}
	
	function insert(text, id) {
		//alert(text);
		$.ajax({
			url : "insert.php",
			method : "POST",
			data : "name=" + text + "&id=" + id
		});
	}

	function collapseAll(){
		var collapseMore=true;
		while(collapseMore){
			var ele = $("span.icon.expand-icon.glyphicon.glyphicon-folder-open");
			if(ele!=null && ele[0]!=null){
				ele.click();
			}else{
				collapseMore=false;
				
			}
		}
	}

	function expandAll(){
		var expandMore=true;
		while(expandMore){
			var ele = $("span.icon.expand-icon.glyphicon.glyphicon-folder-close");
			if(ele!=null && ele[0]!=null){
				ele.click();
			}else{
				expandMore=false;
				
			}
		}
	}
</script>
</head>

<body onload="loadTreeData();">

	<div class="container">
		
		<div class="heading row">
			<h1 class="glyphicon glyphicon-education text text-info" style=""><b><i> Category DashBoard </i><h1 class="glyphicon glyphicon-education"><h1><b></h1>
		</div>	
		
		<div class="middle row">
			

			<div class="btnArea">

		<div class="row">

			<div class="col-sm-1">
				<button type="button" class="btn btn-md btn-success" id="btnRoot">
					<i class="indicator glyphicon glyphicon-tree-deciduous"></i> Root
				</button>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-md btn-info" id="btnChild">
					<i class="indicator glyphicon glyphicon-user"></i> Child
				</button>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-md btn-warning" id="btnEdit">
					<i class="indicator glyphicon glyphicon-edit"></i> Edit
				</button>
			</div>
			<div class="col col-sm-1">
				<button type="button" class="btn btn-md btn-danger" id="btnDelete">
					<i class="indicator glyphicon glyphicon-remove-sign"></i> Delete
				</button>
			</div>
			<div class="lastcol col-sm-1">
				<button type="button" class="btn btn-md btn-success" id="btnRefresh">
					<i class="indicator glyphicon glyphicon-refresh"></i> Refresh
				</button>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-2">
				<button class="btn btn-md btn-success" id="expand"> 
					<i class="indicator glyphicon glyphicon-resize-full"></i>
					 Expand  </button>
			</div>
			
			<div class="col-sm-2">
				<button class="btn btn-md btn-info" id="collapse"> 
					<i class="indicator glyphicon glyphicon-resize-small"></i>
					 Collapse </button>
			</div>
			

		</div>
		<div class="row">
			<div id="inputBox" hidden>
				<input class="input-md inputBox" id="textInput">
				<button type="button" class="btn btn-md btn-success" id="submit">Create</button>
			</div>
		</div>
		<br>
		<br>
		<div class="row" id="categoryTreeMain">

			<div class="col-sm-5">
				<div id="treeview"></div>
			</div>
			
		</div>
		</div>
		</div>
		<br>
</body>
</html>