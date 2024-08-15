<?php

?>

<html >

<body onload="printResult()">
	<h1>Heey </h1>
	
</body>
<script>
 function  getAllProducts()
{
	res= fetch('https://dummyjson.com/products').then(function (res){return res.json()});
	//return res;
	
return res;
	
}
function getSingleProduct()
{
	return fetch('https://dummyjson.com/products/1')
	.then((res)=>{return res.json()}); //
	return fetch;
	
}
function printResult()
{
	let result;
	result= getAllProducts().then((data)=>{console.log(data);document.getElementsByTagName('body')[0].innerText=data.products});
	
	//var b=document.getElementsByTagName('body')[0];
	//b.innerText=result;
	
}

</script>
</html>