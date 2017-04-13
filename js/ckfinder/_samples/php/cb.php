<?
error_reporting(-1);
ini_set('display_errors', 1);
session_start();
$_SESSION['resourceType'] == 'ebrochures';
$_SESSION['IsAuthorized'] = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>CKFinder - Sample - Popups</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex, nofollow" />
    <link href="../sample.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../ckfinder.js"></script>
    <style type="text/css">
    img {
      padding:10px;
      margin:5px;
      border:1px solid #d5d5d5;
    }
    div.thumb {
      float:left;
    }
    div.caption {
      padding-left:5px;
      font-size:10px;
    }
    </style>
    <script type="text/javascript">
    function BrowseServer( startupPath, functionData ){
      var finder = new CKFinder();
      finder.basePath = '../../';
finder.customConfig = '../../config2.js';
      finder.startupPath = 'ebrochures:/';
      finder.selectActionFunction = SetFileField;
      finder.selectActionData = functionData;
      finder.selectThumbnailActionFunction = ShowThumbnails;
      finder.callback = function( api ){
         api.hideTool( "f2" );
         api.openFolder('ebrochures', '/');
         var folder = api.getSelectedFolder();
      }
      var api = (finder).popup();
    }
    function SetFileField( fileUrl, data ){
      document.getElementById( data["selectActionData"] ).value = fileUrl;
    }
    function ShowThumbnails( fileUrl, data ){
      var sFileName = this.getSelectedFile().name;
      document.getElementById( 'thumbnails' ).innerHTML += '<div class="thumb">' +  '<img src="' + fileUrl + '" />' + '<div class="caption">' + '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' + '</div>' + '</div>';
      document.getElementById( 'preview' ).style.display = "";
      return false;
    }
  </script>
</head>
<body>

	<h1 class="samples">
		CKFinder - Sample - Popups<br />
	</h1>
	<div class="description">
		CKFinder may be opened in a popup. You may define a custom JavaScript function to be called when
		an image is selected (double-clicked).</div>
	<p>
		<strong>Selected File URL</strong><br/>
		<input id="xEbrochurePath" name="FilePath" type="text" size="60" />
		<input type="button" value="Browse Server" onclick="BrowseServer( 'ebrochures', 'xEbrochurePath' );" />
	</p>
	<p>
		<strong>Selected Image URL</strong><br/>
		<input id="xEbrochurePath" name="ImagePath" type="text" size="60" />
		<input type="button" value="Browse Server" onclick="BrowseServer( 'ebrochures', 'xEbrochurePath' );" />
	</p>
	<div id="preview" style="display:none">
		<strong>Selected Thumbnails</strong><br/>
		<div id="thumbnails"></div>
	</div>
	<div id="footer">
		<hr />
		<p>
			CKFinder - Ajax File Manager - <a class="samples" href="http://cksource.com/ckfinder/">http://cksource.com/ckfinder</a>
		</p>
		<p id="copy">
			Copyright &copy; 2003-2013, <a class="samples" href="http://cksource.com/">CKSource</a> - Frederico Knabben. All rights reserved.
		</p>
	</div>
</body>
</html>