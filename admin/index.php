<?php 
if($_GET['a']=="save"){
  die((string)file_put_contents("../".$_POST['file'],$_POST['content']));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$_GET['file'];?> [KissEditor]</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="favicon.ico" />
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    .row.content a {color: black;}
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color:saddlebrown;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
    body {
        overflow: hidden;
        background-color: black;
    }

    #editor {
      height: 300px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">KissEditor</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><?=$_GET['file'];?></a></li>
        <li><a style="color: saddlebrown;" href="#"><?=$_GET['t'];?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn-success" id="savebtn" href="#" style="color: black;"><span class="glyphicon glyphicon-floppy-save" ></span> Save</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><h3>YAML Files</h3></p>
      <?php
      $files = array_slice(scandir('../data'), 2);
      foreach($files as $file){ ?>
      <p><a href="?t=yaml&file=data/<?=$file?>"><?=$file?></a></p>
      <?php }?>
      <p><h3>MD Files</h3></p>
      <?php
      $files = array_slice(scandir('../md'), 2);
      foreach($files as $file){ ?>
      <p><a href="?t=markdown&file=md/<?=$file?>"><?=$file?></a></p>
      <?php }?>
    </div>
    <div class="col-sm-10 text-left">
      <pre id="editor"><?=file_get_contents("../".$_GET['file']);?></pre>
    </div>
  </div>
</div>
<script src="flash.js"></script>
<script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>

$("#savebtn").click(function(){
  flash('Saving...', {'bgColor' : 'black','vPosition' : 'top'});
  $.post("?a=save",
  {
    file: "<?=$_GET['file'];?>",
    content: editor.getValue()
  },
  function(data, status){
    if(data)
      flash("Saved succesfully", {'bgColor' : 'seagreen','vPosition' : 'top'});
    else
      flash("Error", {'bgColor' : 'maroon','vPosition' : 'top'});
  });
}); 
    //alert($(window).height());
    
    $(".sidenav").height($(window).height()-60); 
    $("#editor").height($(window).height()-90);
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/<?=$_GET['t']; ?>");
</script>

</body>
</html>
