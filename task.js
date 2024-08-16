/*
	Test task for Social Media Holding 
*/

/*
function  getAllProducts()
{
	res= fetch('https://dummyjson.com/products').then((res)=>{return res.json()});
	//return res;
	
	return res;
	
}
function getSingleProduct()
{
	let ret=fetch('https://dummyjson.com/products/1')
	.then((res)=>{return res.json()}); //
	return ret;
	
}
*/
function searchProduct(product)
{
	let search_str='https://dummyjson.com/products/search?q='+product;
	
	let result=fetch(search_str).then((res)=>{return res.json()});
	return result;
}
function addProduct(product)
{
	
	let result=fetch('https://dummyjson.com/products/add',{
		method:'POST',
		headers:{'Content-Type':'application/json'},
		body:JSON.stringify({
			title:product.title,
			description:product.description,
		})
		
}).then((res)=>{return res});
	
	return result;
}
function printResult()
{
	
	//searchProduct('recipes').then...
	//searchProduct('users').then...
	searchProduct('iPhone')
	.then((data)=>{
		data.products.map((arr)=>
		{
			console.log(arr.title);
			console.log(arr.description);
			var status='Error';
			res=addProduct(arr).then((val)=>{
				return val.status;
					
				} ).then((stat)=>{stat==201?console.log('Item added sucessfully'):console.log('Error adding item');});
			
		}
		
		);
		
		}
			);
			
}
