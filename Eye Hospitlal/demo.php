<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script>
	var xmlHttp;
	function showUname(str){
		if(typeof XMLHttpRequest != "undefined"){
			xmlHttp= new XMLHttpRequest();
		}
		else if(window.ActiveXObject){
			xmlHttp = new ActiveXObject("MicrosoftXMLHTTP");
		}
		if(xmlHttp == null){
			alert("Browser does not support XMLHTTP request");
			return;
		}
		var url = "delivery_xml.php";
		url += "?value=" + str;
		xmlHttp.onreadystatechange = stateChange;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
		
	}
	var txt="";
	function stateChange(){
		
		if(xmlHttp.readyState==4||xmlHttp.readyState=='complete'){
			document.getElementById("demo2").innerHTML = xmlHttp.responseText;
			
			myObj = JSON.parse(xmlHttp.responseText);
        	//document.getElementById("demo2").innerHTML = myObj;
			alert(myObj);
			if(myObj == "noRecord"){
				alert(myObj);
				document.getElementById("update").disabled = true;
				
			}
			
			for (x in myObj) {
            	txt += myObj[x] + "<br>";
        	}
        document.getElementById("demo").innerHTML = txt;
//			document.getElementById("check").innerHTML = xmlHttp.responseText;
		}
	}
</script>
</head>

<body>
<input type="text" onChange="showUname(this.value)">
<div id="demo">
	
</div>
<div id="demo2" style="background-color: aquamarine">
	
</div>
</body>
</html>
