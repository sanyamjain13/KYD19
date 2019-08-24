<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>KYD | Symptom Checker</title>
	<!-- Bootstrap.css version 4.3.1 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="css/style-checker.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">

	<script type="text/javascript">
		$(document).ready(function(){

			form = document.getElementById('info_form');
			btn = document.getElementById('submitForm');

			form.style.display = 'none';
			btn.style.display = 'none';

			$('#title').animate({ 'paddingTop' : '20%'},500).animate({ 'paddingTop' : '15%'},100).animate({ 'paddingTop' : '10%'},100).animate({ 'paddingTop' : '5%'},100,function(){

					// form = document.getElementById('info_form');
					// btn = document.getElementById('submitForm');
					// form.style.display = '';
					// btn.style.display = '';

					$('#info_form').fadeIn(500);
					$('#submitForm').fadeIn(500);
			});



		});

	</script>

</head>
<body>
	<?php
		include 'header.php'
	?>
	<br>
	<!-- <nav class="navbar navbar-expand-sm py-0"> -->
	<script>
			function removeLeft(){
				$('#left').hide();
				$('#middle').show();
			}
			
			function addLeft(){
				$('#middle').hide();
				$('#left').show();
			}

			function getInputs(){
				var symptoms = document.getElementById('sympInp');
				var btns = document.getElementsByClassName('b1');
				var text = '';
				for(var i=0;i<btns.length;i++)
				{
					text+= btns[i].innerHTML;
					text = text.substring(0,text.length-3);
					text += ", ";
				}
				text = text.substring(0,text.length-2);
				symptoms.innerHTML = text.toLowerCase();
			}

			function changeColor(id){
				male = document.getElementById('male');
				female = document.getElementById('female');
				btn = document.getElementById('submitForm');

				if(id == 'male'){
					male.style.background = '#5bc0de';
					male.style.color = '#eee';
					female.style.background = '#e7f2f9';
					female.style.color = '#333';
					$('#two').text(" Male");
					document.getElementById('genderInp').innerHTML= 'Male';
				}

				else if(id== 'female'){
					female.style.background = '#5bc0de';
					female.style.color = '#eee';
					male.style.background = '#e7f2f9';
					male.style.color = '#333';
					$('#two').text(" Female");
					document.getElementById('genderInp').innerHTML= 'Female';
				}

				$("#submitForm").attr("disabled", false);
				btn.style.background = '#5bc0de';

			}

			function changeDiv(id) {
				age = document.getElementById('age').value;
				$('#one').text(" "+age);
				document.getElementById('ageInp').innerHTML=age;
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				var tabs = document.getElementsByClassName('tab-head');
				tabs[1].className = tabs[1].className.replace(" disabled", "");
				tabs[1].click();

			}

			function decideTabp(){
				var left = document.getElementById('left');
				if(left.style.display == 'none')
					changeTab(1);
				else{
					changeTab(0);
				}	
			}

			function decideTabn(){
				var left = document.getElementById('left');
				if(left.style.display == 'none')
					changeTab(3);
				else{
					changeTab(2);
				}	
			}

			function changeTab(i){
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				var tabs = document.getElementsByClassName('tab-head');
				tabs[i].className = tabs[1].className.replace(" disabled", "");
				tabs[i].click();
			}

			function addItem(id) {

				var newItem = document.getElementById(id).innerHTML;
				var btns = document.getElementsByClassName('b1');
				var i=btns.length;
				if(i!=0)
				{
					i = parseInt(btns[i-1].id.substring(1));
					i++;
				}
				var newBtn = "<button class='b1 btn-sm' id='s"+i+"' onclick='removeItem("+id+",s"+i+")'>"+newItem+"  x</button>";
				// alert(newBtn);
				document.getElementById("newList").innerHTML+=newBtn;
				$('#'+id).attr('disabled',true);

			}

			function addItemAuto(text) {
				var btns = document.getElementsByClassName('b1');
				var i=btns.length;
				if(i!=0)
				{
					i = parseInt(btns[i-1].id.substring(1));
					i++;
				}
				var newBtn = "<button class='b1 btn-sm' id='s"+i+"' onclick='removeItemAuto(s"+i+")'>"+text+"  x</button>";
				// alert(newBtn);
				document.getElementById("newList").innerHTML+=newBtn;
				$('#myInput').val("");
			}

			function removeItem(id,btnId) {
				// alert(id.id+" "+btnId.id);
				$("#"+id.id).attr("disabled", false);
				$("#"+btnId.id).remove();
			}

			function removeItemAuto(btnId) {
				// alert(id.id+" "+btnId.id);
				$("#"+btnId.id).remove();
			}

	</script>
	<ul class="nav nav-tabs nav-justified border pr-0 border-dark" id="symptoms_nav">
		<li class="nav-item">
	      <a class="nav-link active tab-head" data-toggle="tab" id="s" href="#info">INFO</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link tab-head disabled"  data-toggle="tab" href="#menu1" onclick="addLeft()" >SYMPTOMS</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link tab-head disabled" data-toggle="tab" href="#menu1" onclick="removeLeft()">QUESTIONS</a>
	    </li>
	    <li class="nav-item">
	    	<a class="nav-link tab-head disabled" data-toggle="tab" href="#results" onclick="getInputs()">CONDITION</a>
	    </li>
	    <li class="nav-item">
	    	<a href="#" class="nav-link tab-head disabled">DETAILS</a>
	    </li>
	    <li class="nav-item">
	    	<a class="nav-link tab-head disabled" href="#">TREATMENT</a>
	    </li>
	</ul>

	<div class="tab-content" id="symptoms_content">
		<!--------------------------------------- INFO ------------------------------------------------>
		<div class="tab-pane m-0 container active" id="info">
			<div class="text-center" id="top_heading">
				<div id="title"><font id="brand">KYD</font> Symptom Checker</div>
				Identify possible conditions and treatment related to your symptoms.
				<br>
				<div class="sm_text">
					This tool does not provide medical advice.
					<a>See additional information.</a>
				</div>
			</div>

			<script type="text/javascript">
				

			</script>

			<form class="row offset-3" id="info_form">
				<div class="form-group col-xs-3 col-md-3 ">
			        <label for="age" class="control-label">Age</label>
			        <input type="number" value="" class="form-control" id="age" style="border:1px solid silver;">
			    </div>
			    <div class="form-group col-xs-4 col-md-4">
			        <label for="gender" class="control-label col-xs-10 col-md-10 text-center">Gender</label>
			        <div class="row">
				        <button id="male" type="button" class="form-control" name="gender" onclick="changeColor(this.id)">
				        	Male
				        </button>
				        <button id="female" type="button" class="form-control" onclick="changeColor(this.id)">
				        	Female
				        </button>
			    	</div>
			    </div>
			</form>
			<button class="offset-4 col-md-3" form="#info_form" disabled="true" id="submitForm" onclick="changeDiv(this.id)"> Continue > </button>
			
		</div>
		<!------------------------------------ INFO ENDS -------------------------------------------->

		<!--------------------------------- SYMPTOMS / QUESTIONS ------------------------------------>
		<div class="tab-pane container fade" id="menu1">

			<div class="row m-0 p-0">
				<div class="col-md-7 " id="left">

					<div class="upper col-md-12" >
						<div class="head">
							<form autocomplete="off">
								<div class="autocomplete" style="width:300px;">
									<label for="symptom" >What is your main symptom?</label>
									<input id="myInput" type="text" name="myCountry"  placeholder="Type your main symptoms"  class="symptom">
								</div>
							</form>
						</div>
					</div>

					<div class="lower col-md-12" >
						<br><br>
						<h6>or Choose common symptoms </h6>
						<div class="row">

							<button type="button" name="button" class="b btn-sm" id="btn1" onClick="addItem(this.id)">bloating</button>
							<button type="button" name="button" class="b btn-sm" id="btn2" onClick="addItem(this.id)">cough</button>
							<button type="button" name="button" class="b btn-sm" id="btn3" onClick="addItem(this.id)">diarrhea</button>
							<button type="button" name="button" class="b btn-sm" id="btn4" onClick="addItem(this.id)">dizziness</button>
							<button type="button" name="button" class="b btn-sm" id="btn5" onClick="addItem(this.id)">fatigue</button>
							<button type="button" name="button" class="b btn-sm" id="btn6" onClick="addItem(this.id)">fever</button>
							<button type="button" name="button" class="b btn-sm" id="btn7" onClick="addItem(this.id)">headache</button>
							<button type="button" name="button" class="b btn-sm" id="btn8" onClick="addItem(this.id)">nausea</button>
							<button type="button" name="button" class="b btn-sm" id="btn9" onClick="addItem(this.id)">muscle cramp</button>
							<button type="button" name="button" class="b btn-sm" id="btn10" onClick="addItem(this.id)">throat irritaion</button>

						</div>
					</div>

				</div>


				<div class="col-md-7 " id="middle" style="display:none;">

					<div class="upper col-md-12" >
						<div class="head ">
							<form autocomplete="off">
								<div class="autocomplete " style="width:300px;">
									<label for="symptom" >Please tell us more</label>
									<br>
									<a href="#">Skip this section</a>
									<br><br><br>
								<label for="">Past or current conditions (optional)</label>

									<input id="myInput2" type="text" name="myCountry"  placeholder="e.g.,Arthritis"  class="symptom">
								</div>
							</form>
						</div>
					</div>

				</div>

				<!------------------------ SIDE MENU -------------------------------->
				<div class="col-md-5 ">
					<!--------------------- AGE/GENDER ------------------------------>
					<div class=" row mb-0">
						<div class="sideup1 p-3">
							<h5 style="font-size:13px;">AGE
								<label for="" id="one" style="font-size:13px;"></label>
							</h5>
						</div>
						<div class="sideup2 p-3">
							<h5 style="font-size:13px;">GENDER
								<label for="" id="two" style="font-size:13px;"></label>
							</h5>
						</div>
					</div>
					<!--------------------- AGE/GENDER END------------------------------>

					<!-------------------------- LOWER SIDE OF RIGHT ------------------------------->
			
						<!--------------------- SYMPTOMS LIST ------------------------------->
						<div class="side" style="height:400px;"> 
							<ul id="newList"></ul>
						</div>
						<!--------------------- SYMPTOMS LIST END------------------------------->

						<!-------------------------- STRENGTH ------------------------------->

						<div style="background:#dff0ea; margin:1% 4% 4%;">
							<p class="ml-3 pt-2 mb-0">
								Results Strength : <span id="strength">MODERATE</span>
							</p>
							<div class="row ml-2">
							
								<div class=" col-md-2 meter"></div>
								<div class=" col-md-2 meter"></div>
								<div class=" col-md-2 meter"></div>
								<div class=" col-md-2 meter"></div>
							</div>

						</div>
						<!-------------------------- STRENGTH END------------------------------->
						
					<!-------------------------- LOWER SIDE OF RIGHT END ------------------------------->
				</div>
				<!------------------------ SIDE MENU END -------------------------------->   

				<br>
				
				<!------------------------ PREVIOUS/ NEXT BUTTONS ------------------------>
				
				<div class="row col-md-12 m-0 mt-3 pt-3" style="border-top:0.5px solid silver;">
				
					<button type="button" name="button" class="col-md-2 btn btn-outline-primary" onclick="decideTabp()">
						Previous
					</button>
					<button type="button" name="button" class="col-md-2 offset-8 btn btn-primary" onclick="decideTabn();">
						Continue
					</button>

				</div>
				
				<!------------------------ PREVIOUS/ NEXT BUTTONS END ------------------------>
			</div>

		</div>

		<script>

			function autocomplete(inp, arr) {
			/*the autocomplete function takes two arguments,
			the text field element and an array of possible autocompleted values:*/
			var currentFocus;
			/*execute a function when someone writes in the text field:*/
			inp.addEventListener("input", function(e) {
				var a, b, i, val = this.value;
				/*close any already open lists of autocompleted values*/
				closeAllLists();
				if (!val) { return false;}
				currentFocus = -1;
				/*create a DIV element that will contain the items (values):*/
				a = document.createElement("DIV");
				a.setAttribute("id", this.id + "autocomplete-list");
				a.setAttribute("class", "autocomplete-items");
				/*append the DIV element as a child of the autocomplete container:*/
				this.parentNode.appendChild(a);
				/*for each item in the array...*/
				for (i = 0; i < arr.length; i++) {
					/*check if the item starts with the same letters as the text field value:*/
					if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
					/*execute a function when someone clicks on the item value (DIV element):*/
					b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.getElementsByTagName("input")[0].value;
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
					}
				}
			});
			/*execute a function presses a key on the keyboard:*/
			inp.addEventListener("keydown", function(e) {
				var x = document.getElementById(this.id + "autocomplete-list");
				if (x) x = x.getElementsByTagName("div");
				if (e.keyCode == 40) {
					/*If the arrow DOWN key is pressed,
					increase the currentFocus variable:*/
					currentFocus++;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 38) { //up
					/*If the arrow UP key is pressed,
					decrease the currentFocus variable:*/
					currentFocus--;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 13) {
					/*If the ENTER key is pressed, prevent the form from being submitted,*/
					e.preventDefault();

					if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();

								addItemAuto($('#'+inp.id).val());
					}
							else{
								addItemAuto($('#'+inp.id).val());
							}
				}
			});
			function addActive(x) {
				/*a function to classify an item as "active":*/
				if (!x) return false;
				/*start by removing the "active" class on all items:*/
				removeActive(x);
				if (currentFocus >= x.length) currentFocus = 0;
				if (currentFocus < 0) currentFocus = (x.length - 1);
				/*add class "autocomplete-active":*/
				x[currentFocus].classList.add("autocomplete-active");
			}
			function removeActive(x) {
				/*a function to remove the "active" class from all autocomplete items:*/
				for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
				}
			}
			function closeAllLists(elmnt) {
				/*close all autocomplete lists in the document,
				except the one passed as an argument:*/
				var x = document.getElementsByClassName("autocomplete-items");
				for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
				}
			}
			/*execute a function when someone clicks in the document:*/
			document.addEventListener("click", function (e) {
				closeAllLists(e.target);
			});
			}

			/*An array containing all the country names in the world:*/
			var symptoms = ["Abnormal gait" ,"Abnormal muscle enlargement","Abnormally round face","Agitation","Anxiety","Apathy","Bad breath","Bad taste in mouth","Bald spots (hair)","Belching","Chills","Choking","Cloudy vision","Coarse hair","Cold feet","Cold hands","Color change","Confusion","Constipation","Cough","Drooping of one side of face","Drowsiness","Dry eyes","Dry mouth","Dry skin"];
			var diseases = ["Arthritis","TB"];
			/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
			autocomplete(document.getElementById("myInput"), symptoms);
			autocomplete(document.getElementById("myInput2"), diseases);
		</script>
		<!--------------------------------- SYMPTOMS / QUESTIONS END ------------------------------------>
		
		<!---------------------------------- CONDITION ------------------------------------------------>
		<div class="col-md-12 tab-pane container fade" id="results">
			<h2 class="col-md-6 pl-2 mb-0 pb-0">Conditions that match your symptoms</h2>
			<div class="blueText col-md-6 mt-0 pt-0 small">
				UNDERSTANDING YOUR RESULTS &nbsp;<i class="fas fa-info-circle fa-lg"></i>
			</div> 

			<!---------------------------- PREDICTION SECTION ------------------------------->
			<div class="row">

				<!------------------------ PREDICTED DISEASES ------------------------------->
				<div class="col-md-6 mt-0 mb-0">
					
					<div class="row ml-3 mt-3 prediction ">
						<div class="col-md-10 p-2">
							<h5 class="p-1">Asthma (Teen and Adult)</h5>

							<div class="row col-md-9">
								<div class="meter"></div>
								<div class="meter"></div>
								<div class="meter-off"></div>
								<div class="meter-off"></div>
							</div>

							<p class="pl-1 pb-0 mb-0">Fair match </p>
						</div>
						<div class="col-md-1 my-auto" style="color:#676767;">
							<i class="fas fa-chevron-right fa-lg"></i>
						</div>	
					</div>

					<div class="row ml-3 mt-3 prediction ">
						<div class="col-md-10 p-2">
							<h5 class="p-1">Acute Sinusitis</h5>

							<div class="row col-md-9">
								<div class="meter"></div>
								<div class="meter"></div>
								<div class="meter-off"></div>
								<div class="meter-off"></div>
							</div>

							<p class="pl-1 pb-0 mb-0">Fair match </p>
						</div>
						<div class="col-md-1 my-auto" style="color:#676767;">
							<i class="fas fa-chevron-right fa-lg"></i>
						</div>	
					</div>

					<div class="row ml-3 mt-3 prediction ">
						<div class="col-md-10 p-2">
							<h5 class="p-1">Common Cold</h5>

							<div class="row col-md-9">
								<div class="meter"></div>
								<div class="meter"></div>
								<div class="meter-off"></div>
								<div class="meter-off"></div>
							</div>

							<p class="pl-1 pb-0 mb-0">Fair match </p>
						</div>
						<div class="col-md-1 my-auto" style="color:#676767;">
							<i class="fas fa-chevron-right fa-lg"></i>
						</div>	
					</div>

					<div class="row ml-3 mt-3 prediction ">
						<div class="col-md-10 p-2">
							<h5 class="p-1">Flu</h5>

							<div class="row col-md-9">
								<div class="meter"></div>
								<div class="meter"></div>
								<div class="meter-off"></div>
								<div class="meter-off"></div>
							</div>

							<p class="pl-1 pb-0 mb-0">Fair match </p>
						</div>
						<div class="col-md-1 my-auto" style="color:#676767;">
							<i class="fas fa-chevron-right fa-lg"></i>
						</div>	
					</div>

					<button class="button col-md-12 ml-3 mt-3 p-2" onclick="changeTab(0)" id="loadMore"> 
						<i class="fas fa-long-arrow-alt-down"></i>&nbsp; LOAD MORE CONDITIONS 
					</button>
				</div>
				<!------------------------ PREDICTED DISEASES END ------------------------------->

				<!------------------------ USER INPUTS ------------------------------------------>
				<div class="col-md-5 offset-1 pl-4">
					<ul class="p-3 m-0 mx-2">
						<li class="float-left w-50">GENDER &nbsp;<span id="genderInp"> Male</span></li>  
						<li class="float-left w-50" style="text-align:center">AGE &nbsp;<span id="ageInp"> 21</span></li>
						<div class="clearfix"></div>
					</ul>
					<ul class="m-0 p-3 mx-2" style="border-top:none;">
						<li>My Symptoms</li>
						<li class="pt-2">
							<span id="sympInp">cough</span>
						<li>
					</ul>

					<button class="button btn-small m-5 p-3 w-50" onclick="changeTab(0)" id="startOver"> <i class="fas fa-redo"></i>&nbsp; Start Over </button>
				</div>
				<!------------------------ USER INPUTS END ------------------------------------------>

			</div>
			<!---------------------------- PREDICTION SECTION END ------------------------------->
			
			<!------------------------ PREVIOUS/ NEXT BUTTONS ------------------------>
			<div class="row col-md-12 m-0 mt-3 pt-3" style="border-top:0.5px solid silver;">
				
				<button type="button" name="button" class="col-md-2 btn btn-outline-primary" onclick="changeTab(2)">
					Previous
				</button>
				<button type="button" name="button" class="col-md-2 offset-8 btn btn-primary" onclick="changeTab(4);">
					Continue
				</button>

			</div>
			<!------------------------ PREVIOUS/ NEXT BUTTONS END ------------------------>
		</div>
		<!---------------------------------- CONDITION ------------------------------------------------>

	</div>
</body>
</html>
