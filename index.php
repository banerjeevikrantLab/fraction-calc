<html>
  <head>
  <style>
  	body{
  		background-color: black;
  	}
  	#heading {
  		color : yellow;
  		background-color: blue;
  		font-size : 35px;
  		font-family : verdana;
  	}
  	#sub-heading {
  		color: yellow;
  		background-color: green;
  		font-size: 25px;
  		font-family: sans-serif;
  	}
  	.information {
  		color: white;
  	}
  	#list-div {
	    background-color: black;
	    width: 300px;
	    padding: 25px;
	    border: 25px solid navy;
	    margin: 25px;
	    
	}
	#heading-text{
		text-align: center;
		font-size: 40px;
		color: blue;
	}
	.main{
		background-color: #40bfbf;
		height: 610px;
		width: 380px;
		position: relative;
		top: 35px;
		left: 40%;
		border: 1px outset black;
		border-radius: 10px;
		webkit-box-shadow: 13px 9px 31px 0px rgba(168,168,168,0.65);
		-moz-box-shadow: 13px 9px 31px 0px rgba(168,168,168,0.65);
		box-shadow: 13px 9px 31px 0px rgba(168,168,168,0.65);	
	}
	.border{
		border: 1px outset black;
		background-color: #8cd9d9;
		height: 575px;
		width: 350px;
		padding-left: 10px;
		position: relative;
		top: 7px;
		left: 7px;
	}
	.inner{
		position: relative;
		top: 10px;
		left: 1.5%;
	}
	.button{
		height: 40px;
		width: 70px;
		margin-left: 5px;
		margin-top: 3px;
		font-size:16px;
	}
	
	.number.button{
		background-color: hsl(180, 52%, 90%);
		color: #194d4d;
	}
	.symbol.button{
		background-color: #63cfcf;
		color: #194d4d;
	}
	.zero.button{
		height: 40px;
		width: 150px;
		background-color: hsl(180, 52%, 90%);
		color: #194d4d;
	}
	.frac.button{
		height: 40px;
		width: 150px;
		background-color: #00ffff;
		color: #194d4d;
	}
	.symbol.button.frac{
		height: 40px;
		width: 70px;
	}
	.symbol.button.equal{
		background-color: #ff6600;
	}
	.button:hover {
		background-color: #007fff;
		color: white;
		font-size:16px;
		font-weight: bold;
		
	}
	.button.symbol.equal {
	  transition: transform .8s ease-in-out;
	}
	.button.symbol.equal:hover {
	  transform: rotate(360deg);
	  background-color: #ff3300;
	}
	#n{
		border: 1px outset black;
		width: 330px;
		height: 60px;
		font-size: 25px;
	}
	#memory{
		border: 1px outset black;
		width: 330px;
		position: relative;
		top: 20px;
		font-size: 25px;
		text-align: right;
		background-color: #ecf9f9;
	}
	#display{
		border: 1px outset black;
		border-top: 1px solid blue;
		width: 330px;
		height: 80px;
		font-size: 28px;
		position: relative;
		overflow: auto;
	}
	.denom{
		border-top:1px solid black;
	}
	#display_content,#n_content {
		float:right;
		width:auto;
		font-family: "courier";
	}
	.frac-part {
		text-align: center;
	}
	#display .frac-part{
		font-size: 28px;
		font-family: "courier";
	}
	.showonhover .hovertext { display: none;left:-75%}
	.showonhover:hover .hovertext {display: inline;}
	a.viewdescription {color:#999;}
	a.viewdescription:hover {background-color:#999; color: White;}
	.hovertext {
		position:absolute;
		border:1px solid #ffd971;
		background-color:#fffdce;
		padding:10px;
		width:250px;
		font-size: 0.75em;
	}
	#m-indicator{
		float: left;
		font-size: 20px;
		font-family: "courier";
	}
  </style>
  </head>
			
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="fractionlib.js"></script>
<script>
var acc;
var acc_op = "none";
var curr = new Fraction(0,1);

var asFraction = 0;
var asDecimal =  1;
var asMixed = 2;
var displayType;
var editNumerator;
var afterDecimal;
var probSolved = false;
var memory = new Fraction(0,1);

function refreshDisplay() {
	if (displayType == asFraction) {
		$("#display_content").html(curr.toFrac());
	} else if (displayType == asMixed) {
		$("#display_content").html(curr.toMix());
	} else { //asDecimal
		$("#display_content").html(curr.toDec());
	}
}
function addToHistory(new_opnd, new_op) {
    $("#n_content table tr:first").append("<td>"+new_opnd.n+"</td><td rowspan=2>"+new_op+"</td>");
    $("#n_content table tr:last").append("<td class='denom'>"+new_opnd.d+"</td>");
}
function restartHistory() {
    $("#n_content tr").html("");
}
function clearCurr() {
	curr = new Fraction(0,1);
	displayType =  asDecimal;
	editNumerator = true;
	afterDecimal =  false;
}
function computeResult() {
	var result;
	switch(acc_op) {
		case '+': result = Fraction.add(acc,curr); break;
		case '-': result = Fraction.subtract(acc,curr); break;
		case '\u00D7': result = Fraction.multiply(acc,curr); break;
		case '/': result = Fraction.divide(acc,curr); break;
	}  
	return result;                                              
}


$(function() {
	$("#dec").click(function(){
		if(displayType==asDecimal) {
			displayType = asFraction;
		} else {
			displayType = asDecimal;
		}
		refreshDisplay();
	});
	$("#mix").click(function(){
		if(displayType==asMixed) {
			displayType = asFraction;
		} else {
			displayType = asMixed;
		}
		refreshDisplay();
	});
	$("#x-y").click(function(){
		displayType = asFraction;
		editNumerator = false;
		curr.d = 0;
	});
	$(".number").click(function() {
		if (probSolved == true){
			clearCurr();
			acc_op = "none";
			restartHistory();
			probSolved = false;
		}
		if (editNumerator) {
			if (displayType == asDecimal && afterDecimal) {
				curr.d *= 10;
			}
			curr.n = curr.n*10 + Number($(this).val());
		} else {
			curr.d = curr.d*10 + Number($(this).val());
		}
		refreshDisplay();
	});
	$(".symbol").click(function() {
		switch ($(this).val()) {
			case "AC":
				clearCurr();
				acc_op = "none";
				restartHistory();
				break;
			case "DEL":
				if (editNumerator) {
					if (displayType == asDecimal && afterDecimal) {
						if (curr.d == 1) {
							afterDecimal = false;
						} else {
							curr.d /= 10;
						}
					}
					curr.n = Math.floor(curr.n/10);
				} else {
					curr.d = Math.floor(curr.d/10);
				}
				break;
			case "M+":
				memory = Fraction.add(memory,curr);
				probSolved = true;
				$('#m-indicator').text("M")
				break;
				
			case "M-":
				memory = Fraction.subtract(memory,curr);
				probSolved = true;
				$('#m-indicator').text("M")
				break;
			
			case "MR":
				curr = memory;
				probSolved = true;
				break;
			
			case "MC":
				memory = new Fraction(0,1);
				probSolved = true;
				$('#m-indicator').text("")
				break;
				
			case ".":
				afterDecimal = true;
				break;
			case "+": case "-": case '\u00D7': case '/':
				if (acc_op != "none") {
					acc = computeResult();
					acc_op  = $(this).val();
					addToHistory(curr, acc_op);
				} else {
					acc = curr;
					acc_op  = $(this).val();
					restartHistory();
					addToHistory(curr, acc_op);
				}
				
				clearCurr();
				break;
			case "=":
				if (acc_op != "none") {
					addToHistory(curr, "=");
					curr = computeResult();
					acc = curr;
					acc_op = "none"
				}else{
					restartHistory();
					addToHistory(curr, "=");
					curr = new Fraction(curr.n, curr.d);
				}
				probSolved = true;
				break;
			default: break;
		}
		refreshDisplay();
	});
	clearCurr();
	refreshDisplay();
});


</script>
	</head>
	<body>
		<div id = "heading-text">Fraction Calculator</div>
		<div class = "main">
			<div class = "border">
				<div id = "memory">
				<div id= "n"><div id="n_content"><table><tr><td></td></tr><tr><td></td></tr></table></div></div>
				<div id = "display"><div id = "m-indicator"></div><div id="display_content"></div></div></div>
				<div>
				<div class = "inner">
					<p class = "second-row">
						<input class = "symbol button" type = "button" value = "M+">
						<input class = "symbol button" type = "button" value = "M-">
						<input class = "symbol button" type = "button" value = "MR">
						<input class = "symbol button" type = "button" value = "MC">
						
					</p>

					<p class = "first-row">
						<td>
						    <span class="showonhover">
						        <a href="#"><input class = "symbol button frac" id="x-y" type = "button" value = "x/y"></a>
						        <span class="hovertext">
						            Click this button to start writing the denominator!
						        </span>
						    </span>
						</td>
												
						<input class = "symbol button" type = "button" value = "AC">
						<input class = "symbol button" type = "button" value = "DEL">
						<input class = "symbol button equal" type = "button" value = "=">
	
					</p>
					<p class = "second-row">
						<input class = "number button" type = "button" value = "7">
						<input class = "number button" type = "button" value = "8">
						<input class = "number button" type = "button" value = "9">
						<input class = "symbol button" type = "button" value = "/">
						
					</p>
					
					<p class = "third-row">
						<input class = "number button" type = "button" value = "4">
						<input class = "number button" type = "button" value = "5">
						<input class = "number button" type = "button" value = "6">
						<input class = "symbol button" type = "button" value = "&#x00D7;">
						
					</p>
					<p class = "forth-row">
						<input class = "number button" type = "button" value = "1">
						<input class = "number button" type = "button" value = "2">
						<input class = "number button" type = "button" value = "3">
						<input class = "symbol button" type = "button" value = "-">
						
					</p>
					<p class = "fifth-row">
						<input class = "symbol button" type = "button" value = ".">
						<input class = "zero number button" type = "button" value = "0">
						<input class = "symbol button" type = "button" value = "+">
						
					</p>
					<p class = "sixth-row">
						<input class = "frac dec button" id="dec" type = "button" value = "Decimal/Fraction">
						<input class = "frac mix button" id="mix" type = "button" value = "Mixed/Improper">
					</p>
				</div>
			</div>	
		</div>
	</body>
</html>

























