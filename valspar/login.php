<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <script src="js/jquery-latest.js"></script>
        <script type="text/javascript">
/*
			function getQueryString( paramName )
			{ 
				paramName = paramName .replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]").toLowerCase(); 
				var reg = "[\\?&]"+paramName +"=([^&#]*)"; 
				var regex = new RegExp( reg ); 
				var regResults = regex.exec( location.href.toLowerCase() ); 
				if( regResults == null ) return ""; 
				else return regResults [1]; 
			} 
*/		
		if( location.search.indexOf("GetDC") == -1 )
		{
			var oauth_url = 'https://www.facebook.com/dialog/oauth/';
			oauth_url += '?client_id=492668300762232';
			oauth_url += '&redirect_uri=' + encodeURIComponent('https://23.21.84.9/Valspar/');
			oauth_url += '&scope=publish_stream';
			oauth_url += '&state=GetDC';
			window.top.location = oauth_url;
		}
		else if( location.search.indexOf("AfterGetDC") == -1 )
		{
			var oauth_url = 'https://www.facebook.com/dialog/oauth/';
			oauth_url += '?client_id=492668300762232';
			oauth_url += '&redirect_uri=' + encodeURIComponent('https://apps.facebook.com/valspar/');
			oauth_url += '&scope=publish_stream';
			oauth_url += '&state=AfterGetDC';
			window.top.location = oauth_url;
		}
			
        </script>
<title>Valspar</title>
</head>

<body>

</body>
</html>