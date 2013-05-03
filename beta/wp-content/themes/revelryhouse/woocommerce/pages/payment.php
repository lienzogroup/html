<div id="payment"> 
	<label>CARDHOLDER'S NAME</label><br>
	<input id="input1" type="text" value=""/><br>
	<label>CREDIT CARD NUMBER</label><br>
	<input id="input1" type="password" value=""/><br>
	<div id="exp-date">
		<label>EXPIRATION DATE</label><br>
		<input id="input-month" type="text" value="MM"/><span id="date-separator">/</span><input id="input-year" type="text" value="YYYY"/><br>
	</div>
	<label>CVV</label><br>
	<input id="input3" type="password" value=""/><br>

	<p>
		<input class="checkbox" type="checkbox" >
		<span>Save this card for later</span>
		<br>
	</p>
	<p>
		<input class="checkbox" type="checkbox" >
		<span>My billing address is the same as my shipping address</span>
		<br>
	</p>
	<div id="billing">
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
	</div>
</div>

<style>
	#process_container #left #payment {
		margin-left: 70px;
	}

	#process_container #left #payment label {
		color: #a08f64;
	}
	
	#process_container #left #payment input[type="text"], input[type="password"] {
		border: none;
		border-bottom: 1px solid;
		border-radius: 0;
		font-size: 25px;
		margin-bottom: 35px;
	}
	
	#process_container #left #payment span {
		font-size: 18px;
	}	
	
	#process_container #left #payment #exp-date  {
		float: left;
		margin-right: 30px;
	}
	
	#process_container #left #payment #billing{
		margin-top: 30px;
	}
	#process_container #left #payment #billing label{
		color: #b2b2b2;
	}
	#process_container #left #payment #billing input{
		color: #b2b2b2;
	}
	
	#process_container #left #billing #city{
	float:left;	
	margin-right: 40px;
	}
	
	#process_container #left #payment #date-separator{
		font-size: 45px;
	}
	#process_container #left #payment #input-month{
		width: 130px;
		margin-right: 10px;
	}
	#process_container #left #payment #input-year{
		width: 180px;
		margin-left: 5px;
	}
	
	#process_container #left #payment #input1 {
		width: 500px;
	}
	#process_container #left #payment #input2 {
		width:320px;
	}
	#process_container #left #payment #input3{
		width: 120px;
	}
	
</style>