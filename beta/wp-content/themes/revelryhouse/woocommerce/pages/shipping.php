<div id="shipping">
	<label>NAME</label><br />
	<input id="input1" type="text" value=""/><br />
	<label>ADDRESS</label><br />
	<input id="input1" type="text" value=""/><br />
	<label>APT. #, FLOOR, ETC.</label><br />
	<input id="input1" type="text" value=""/><br />
	<div id="city">
		<label>CITY</label><br />
		<input id="input2" type="text" value=""/>
	</div>
	
	<label>STATE</label><br />
	<input id="input3" type="text" value=""/><br />
	<label>ZIP CODE</label><br />
	<input id="input2" type="text" value=""/><br />
	<label>WHERE IS THIS?</label><br />
	<input id="input2" type="text" value="e.g. 'work'" style="color:#b2b2b2"/>
</div>

<style>
	#user_container #content #shipping,
	#process_container #content  #left #shipping {
		margin-left: 70px;
	}
	
	#user_container #content  #shipping label,
	#process_container #content  #left #shipping label {
		text-transform: uppercase;
		margin-bottom: 10px;
		color: #A08F64;
		font-family: 'UniversLTW01-49LightUlt';
		font-size: 18px;
	}
	
	#user_container #content  #shipping input,
	#process_container #content  #left #shipping input {
	border: none;
	border-bottom: 1px solid;
	border-radius: 0;
	font-size: 25px;
	}
	
	#user_container #content #shipping #city,
	#process_container #left #shipping #city{
	float:left;	
	margin-right: 40px;
	}
	
	#user_container #content #shipping #input1,
	#process_container #left #shipping #input1 {
		width:500px;
	}
	#user_container #content #shipping #input2,
	#process_container #content #left #shipping #input2 {
		width:320px;
	}
	#user_container #content #shipping #input3,
	#process_container #left #shipping #input3 {
		width:130px;
	}
	
</style>