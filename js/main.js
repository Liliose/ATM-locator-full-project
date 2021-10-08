const signupClientValidator = () => {
  if(name.value == '' || name.value.length === 0){
    nameError.innerHTML = "Please enter your name.";
    nameCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    nameError.style.display = 'block';
    name.focus();
  }else if(email.value == ''){
    emailError.innerHTML = "Please enter your email address.";
    emailCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    emailError.style.display = 'block';
    email.focus();
  }else if(validateEmail(email.value) === false){
    emailError.innerHTML = "Invalid email address, try agin.";
    emailCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    emailError.style.display = 'block';
    email.focus();
  }else if(username.value == '' || username.value.length === 0){
    usernameError.innerHTML = "Please enter your username.";
    usernameCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    usernameError.style.display = 'block';
    username.focus();
  }else if(password.value.length < 4){
    passwordError.innerHTML = "Password must be at least 4 characters.";
    passwordCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    passwordError.style.display = 'block';
    password.focus();
  }else if(password2.value !== password.value){
    password2Error.innerHTML = "Passwords do not match.";
    password2CheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    password2Error.style.display = 'block';
    password2.focus();
  }else{
    submitSignupForm();
  }
}
const emailInput = () => {
  if(email.value == ''){
    emailError.innerHTML = "Please enter your email address.";
    emailCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    emailError.style.display = 'block';
    email.focus();
  }else if(validateEmail(email.value) === false){
    emailError.innerHTML = "Invalid email address, try agin.";
    emailCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    emailError.style.display = 'block';
    email.focus();
  }else{
    emailError.innerHTML = "";
    emailError.style.display = 'none';
    emailCheckMark.innerHTML = "<i class='fa fa-check text-success'></i>";
  }
}
const nameInput = () => {
  if(name.value == '' || name.value.length === 0){
    nameError.innerHTML = "Please enter your name.";
    nameCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    nameError.style.display = 'block';
    name.focus();
  }else{
    nameError.innerHTML = "";
    nameError.style.display = 'none';
    nameCheckMark.innerHTML = "<i class='fa fa-check text-success'></i>";
  }
}
const usernameInput = () => {
  if(username.value == '' || username.value.length === 0){
    usernameError.innerHTML = "Please enter your username.";
    usernameCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    usernameError.style.display = 'block';
    username.focus();
  }else{
    usernameError.innerHTML = "";
    usernameError.style.display = 'none';
    usernameCheckMark.innerHTML = "<i class='fa fa-check text-success'></i>";
  }
}
const password2Input = () => {
  if(password2.value !== password.value){
    password2Error.innerHTML = "Passwords do not match.";
    password2CheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    password2Error.style.display = 'block';
    password2.focus();
  }else{
    password2Error.innerHTML = "";
    password2Error.style.display = 'none';
    password2CheckMark.innerHTML = "<i class='fa fa-check text-success'></i>";
  }
}
const passwordInput = () => {
  if(password.value.length < 4){
    passwordError.innerHTML = "Password must be at least 4 characters.";
    passwordCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
    passwordError.style.display = 'block';
    password.focus();
  }else{
    passwordError.innerHTML = "";
    passwordError.style.display = 'none';
    passwordCheckMark.innerHTML = "<i class='fa fa-check text-success'></i>";
  }
}
const submitSignupForm = () => {
  signupBtn.innerHTML = spin + ' Loading...';
  const data = {
    signup: 1,
    name: name.value,
    email: email.value,
    username: username.value,
    password: password.value,
    password2: password2.value
  }
  $.ajax({
    url: 'server',
    method: 'post',
    data,
    success: data => {
      if(data === 'success'){
        window.location = "profile";
      }else if(data === 'name'){
        nameError.innerHTML = "Please enter your name.";
        nameCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
        nameError.style.display = 'block';
        signupBtn.innerHTML = 'Signup';
        name.focus();
      }else if(data === 'email'){
        emailError.innerHTML = "Invalid email address, try agin.";
        emailCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
        emailError.style.display = 'block';
        signupBtn.innerHTML = 'Signup';
        email.focus();
      }else if(data === 'username'){
        usernameError.innerHTML = "Username already exists, try another one.";
        usernameCheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
        usernameError.style.display = 'block';
        signupBtn.innerHTML = 'Signup';
        username.focus();
      }else if(data === 'password'){
        password2Error.innerHTML = "Passwords do not match.";
        password2CheckMark.innerHTML = "<i class='fa fa-close text-danger'></i>";
        password2Error.style.display = 'block';
        signupBtn.innerHTML = 'Signup';
        password2.focus();
      }else{
        console.log(data)
        alert('Something went wrong, try again later!');
        window.location = "signup";
      }
    }
  });
}
const handleLoginForm = (event) => {
  event.preventDefault();
  loginBtn.innerHTML = spin + ' Loading...';
  const data = {
    login: 1,
    pwd: loginPassword.value,
    username: loginUsername.value
  }
  $.ajax({
    url: 'server',
    method: 'POST',
    data,
    success: data => {
      console.log(data)
      if(data === 'success'){
        loginError.classList.add('d-none');
        setTimeout(() => {window.location = "profile";},700);
      }else if(data === 'success2'){
        loginError.classList.add('d-none');
        setTimeout(() => {window.location = "admin";},700);
      }else{
        loginError.innerHTML = data;
        loginError.classList.remove('d-none');
        if(data == 'Wrong password'){loginPassword.focus();}else{loginUsername.focus();}
        setTimeout(() => {loginBtn.innerHTML = 'Login';},200);
      }
    }
  });
}
const validateEmail = email => {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
const handleBgs = (locationCaptured = false) => {
  if(locationCaptured){
    //incase location is captured
  }else{
    bgCounter = 1;
    let bgs = setInterval(() => {
      for(let i = 1; i <= 5; i++){
        profilePage.classList.remove('bg_marker'+ i);
      }
      profilePage.classList.add('bg_marker'+ bgCounter);
      bgCounter++;
      if(bgCounter > 5){
        bgCounter = 1;
      }
    }, 3000);
    bgIntervals.push(bgs);
  }
}


const permissions = () => {
  navigator.permissions.query({name:'geolocation'}).then(function(result) {
    if (result.state == 'granted') {
      report(result.state);
      showProcesses('waiting2');
      getLocation();
    } else if (result.state == 'prompt') {
      report(result.state);
      showProcesses('waiting');
      getLocation();
    } else if (result.state == 'denied') {
      report(result.state);
      showProcesses('denied');
    }
    result.onchange = function() {
      report(result.state);
    }
  });
}
const report = state => {
  console.log('Permission ' + state);
}
const getLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition,handlePosition,{timeout:10000});
  } else {
    showProcesses('failed');
  }
}
const showPosition = position => {
  showProcesses('success');
  lt = position.coords.latitude;
  ln = position.coords.longitude;
  console.log("Latitude: " + lt + " Longitude: " + ln);
}
const handlePosition = err => {
  switch(err.code){
    case 0:
      showProcesses('failed');
    break;
    case 1:
      showProcesses('denied');
    break;
    case 2:
      showProcesses('browserFailed');
    break;
    case 3:
      if(attempts < 2){
        showAttemptPrompt();
        getLocation();
        setTimeout(() => {
          if(attempts == 2){
            showProcesses('stillTrying');
          }else{
            showProcesses('trying');
          }
        },1000);
        attempts += 1;
      }else{
        hideAttemptPrompt();
        showProcesses('triedButFailed');
      }
    break;
  }
}
const showAttemptPrompt = () => {
  locationPrompt.classList.add('hide-location-prompt');
  locationAttempt.classList.remove('hide-location-attempt');
  locationAttempt.classList.add('show-location-attempt');
};
const hideAttemptPrompt = () => {
  locationAttempt.classList.remove('show-location-attempt');
  locationAttempt.classList.add('hide-location-attempt');
  locationPrompt.classList.remove('hide-location-prompt')
};
const getBankList = () => {
  if(isNaN(ln) || isNaN(lt)){
    locationAttempt.innerHTML = `
    <div class="centered-content mt-3">
    <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p class="m-0">No internet connection.</p>
      <p>Try again later.</p>
    </div>
    `;
  }else{
    const data = {bankList: 1};
    locationAttempt.innerHTML = `
    <div class="centered-content mt-3">
      <div class="loader" style="animation-delay:0s;"></div>
    </div>
    <div class="text-center pt-3">
      <p><b>Getting Bank list...</b></p>
    </div>
    `;
    $.ajax({
      url: 'server',
      method: 'POST',
      data,
      success: data => {
        try {
          let result = JSON.parse(data);
          if(result.length > 0 && typeof result === 'object'){
            console.log(result);
            locationAttempt.innerHTML = "<h2>Choose Bank Name:</h2>";
            let list = '<ol type="1">';
            result.forEach(bank => {
              list += `<li><input type='radio' name='banks' value='${bank.name}' onclick="setBankName(this)"> ${bank.name}</li>`;
            });
            list += `</ol>`;
            list += `<button class='btn btn-primary mt-2 w-100' onclick='getAtms()'>OK</button>`;
            $('#locationAttempt').append(list);
          }else{
            locationAttempt.innerHTML = `
            <div class="centered-content mt-3">
            <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
            </div>
            <div class="text-center pt-3">
              <p>No Banks found. You must wait for admins to do their job!</p>
            </div>
            `;
          }
        } catch (error) {
          console.log(error);
          locationAttempt.innerHTML = `
          <div class="centered-content mt-3">
          <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
          </div>
          <div class="text-center pt-3">
            <p>No Banks found. You must wait for admins to do their job!</p>
          </div>
          `; 
        }
      }
    })
  }
}
function setBankName(bank) {bankName = bank.value;}
const givemeIcon = decision => {
  let icon = '';
  if(decision == 'YES'){icon = "<i class='fa fa-check-circle'></i>";}
  else{icon = "<i class='fa fa-close'></i>";}
  return icon;
}
const getAtms = () => {
  if(bankName != ''){
    locationAttempt.innerHTML = `
    <div class='text-center percentages' id='percentages'>0%</div>
    <div class='progress-container'>
      <div class='progress-counter' id='progressCounter'></div>
    </div>
    <div class='mb-2 pt-2'><b>Getting All ATMs around you...</b></div>
    `;
    //get atms
    let form_data = new FormData();              
    form_data.append('getAtms', 1);
    form_data.append('bankName', bankName);
    let xhr = new XMLHttpRequest();
		xhr.open('POST', 'server', true);
		xhr.upload.onprogress = function(e) {
			if (e.lengthComputable) {
				var percentComplete = (e.loaded / e.total) * 100;
				percentComplete = Math.trunc(percentComplete);
				$('#progressCounter').css('width',percentComplete + '%');
				$('#percentages').html(percentComplete +'%');
			}
		};
		xhr.onload = function() {
      try {
        let result = JSON.parse(xhr.response);
        if(result.length === 1 && result[0].data == 0){
          setTimeout(() => {$('#prompts').hide();},700);
          $('#atmResultsHeader').html('<h1>No atm Found.</h1>');
          $('#atmResults').html(`
            <div class="not-found">
              <i class="fa fa-exclamation-triangle text-danger"></i> No atms found for ${bankName}, choose another bank and try again later.
            </div>
            <br><br>
            <div class="not-found d-block">
              <i class="fa fa-info-circle text-warning"></i> <small class="text-success">Click on bank name button and choose another bank</small>
            </div>
          `);
        }else{
          setTimeout(() => {$('#prompts').hide();},700);
          console.log(result);
          //generate new array according to the distance
          let atmsWithDistance = [];
          result.forEach(atm => {
            let elem = {
              bankName: atm.bankName,
              district: atm.district,
              sector: atm.sector,
              cell: atm.cell,
              village: atm.village,
              address: atm.address,
              functioning: atm.functioning,
              meter: distance(atm.lat,atm.lon,lt,ln)
            };
            atmsWithDistance.push(elem);
          });
          displayAtms(atmsWithDistance);
        }
      } catch (error) {
        locationAttempt.innerHTML = `
        <div class="centered-content mt-3">
          <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
        </div>
        <div class="text-center pt-3">
          <p>Something went wrong, try again later!</p>
        </div>`;
        console.log(error);
      }
		};
		xhr.send(form_data);
  }else{
    alert('Select Your Bank');
  }
}
const displayAtms = allAtms => {
  let nearestAtms = [];
  let otherAtms = [];
  //sort the array first
  allAtms.sort(function (x, y) {
    return x.meter - y.meter;
  });
  //get nearest Atms
  allAtms.forEach(elem => {
    if(elem.meter <= maximumKilometers){
      nearestAtms.push(elem);
    }
  });
  //get atms at far distance
  let x = 1;
  for(let i = 0; i < allAtms.length; i++){
    if(x <= 10){
      if(allAtms[i].meter > maximumKilometers){
        otherAtms.push(allAtms[i]);
        x++;
      }
    }else{
      break;
    }
  }
  //display results on the screen
  setTimeout(() => {$('#prompts').hide();},700);
  $('#atmResultsHeader').html('<h1>Found '+ nearestAtms.length +' ATMs nearest to you.</h1>');
  $('#atmResults').html('');
  nearestAtms.forEach(atm => {
    let column = `
    <div class='col-md-4 separate'>
      <div class='atm-container'>
        <div class='atm-header'>
          <h2>${atm.bankName} ATM</h2>
          <div class='row'>
            <div class='col'>
              <i class='fa fa-credit-card' style='font-size:5em'></i>
            </div>
            <div class='col'>
              <p class='text-right'>${Math.round(atm.meter*1000)/1000} Km</p>
              <p class='text-right'>Functioning: ${givemeIcon(atm.functioning)}</p>
            </div>
          </div>
        </div>
        <div class='atm-body'>
          <ul>
            <li><b>District:</b> ${atm.district}</li>
            <li><b>Sector:</b> ${atm.sector}</li>
            <li><b>Cell:</b> ${atm.cell}</li>
            <li><b>Village:</b> ${atm.village}</li>
            <li><b><i class='fa fa-map-marker'></i> ${atm.address}</b></li>
          </ul>
        </div>
      </div>
    </div>
    `;
    $('#atmResults').append(column);
  });
  //display atms at long distance
  if(nearestAtms.length === 0){
    $('#atmResultsHeader').html('<span class="text-danger" style="font-family:cursive"><i class="fa fa-exclamation-triangle"></i> No atms nearest by you. Please checkout the following suggestions:</span>');
    $('#atmResultsHeader').append('<div class="atm-main-header mt-2"><h1>Found '+ otherAtms.length +' ATMs at more than '+ maximumKilometers +'km from you.</h1></div>');
    otherAtms.forEach(atm => {
      let column = `
      <div class='col-md-4 separate'>
        <div class='atm-container'>
          <div class='atm-header'>
            <h2>${atm.bankName} ATM</h2>
            <div class='row'>
              <div class='col'>
                <i class='fa fa-credit-card' style='font-size:5em'></i>
              </div>
              <div class='col'>
                <p class='text-right'>${Math.round(atm.meter*1000)/1000} Km</p>
                <p class='text-right'>Functioning: ${givemeIcon(atm.functioning)}</p>
              </div>
            </div>
          </div>
          <div class='atm-body'>
            <ul>
              <li><b>District:</b> ${atm.district}</li>
              <li><b>Sector:</b> ${atm.sector}</li>
              <li><b>Cell:</b> ${atm.cell}</li>
              <li><b>Village:</b> ${atm.village}</li>
              <li><b><i class='fa fa-map-marker'></i> ${atm.address}</b></li>
            </ul>
          </div>
        </div>
      </div>
      `;
      $('#atmResults').append(column);
    });
  }
}
const showProcesses = processeName => {
  if(processeName === 'waiting2'){
    locationPrompt.innerHTML = `
    <div class="centered-content mt-3">
      <div class="loader" style='animation-delay:0s'></div>
    </div>
    <div class="text-center pt-3">
      <p>Waiting for location...</p>
    </div>`;
  }
  if(processeName === 'waiting'){
    locationPrompt.innerHTML = `
    <div class="centered-content mt-3">
      <div class="loader"></div>
    </div>
    <div class="text-center pt-3">
      <p>Waiting for location...</p>
    </div>`;
  }
  if(processeName === 'failed'){
    locationPrompt.innerHTML = `
    <div class="centered-content mt-3">
      <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p>Something went wrong while accessing your location, try again later!</p>
    </div>`;
  }
  if(processeName === 'denied'){
    locationPrompt.innerHTML = `
    <div class="centered-content mt-3">
      <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p>You denied us to access your location, change this from your browser settings and try again later.</p>
    </div>`;
  }
  if(processeName === 'browserFailed'){
    locationPrompt.innerHTML = `
    <div class="centered-content mt-3">
      <i class='fa fa-exclamation-circle text-danger' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p>Your browser failed to determine your location, use different browser (chrome or fire fox are recommended)</p>
    </div>`;
  }
  if(processeName === 'trying'){
    locationAttempt.innerHTML = `
    <div class="centered-content mt-3">
      <i class='fa fa-exclamation-circle text-warning' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p>${spin} We are still trying to know your loction...</p>
    </div>`;
  }
  if(processeName === 'stillTrying'){
    locationAttempt.innerHTML = `
    <div class="centered-content mt-3">
      <i class='fa fa-exclamation-circle text-danger' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p>${spin} Still trying...</p>
    </div>`;
  }
  if(processeName === 'triedButFailed'){
    locationPrompt.innerHTML = `
    <div class="centered-content mt-3">
      <i class='fa fa-exclamation-triangle text-danger' style='font-size:5em'></i>
    </div>
    <div class="text-center pt-3">
      <p>We tried more than once but failed, check your connection or use different browser (chrome or firefox are recommended).</p>
    </div>`;
  }
  if(processeName === 'success'){
    setTimeout(() => {
      locationPrompt.innerHTML = `
      <div class="centered-content mt-3">
        <i class='fa fa-check-circle text-success' style='font-size:5em'></i>
      </div>
      <div class="text-center pt-3">
        <p><b>We found your location!</b></p>
      </div>`;
      showAttemptPrompt();
      getBankList();
    }, 2000);
  }
}
const chooseBank = () => {
  $('#prompts').show();
  showAttemptPrompt();
  getBankList();
}
const showUserMenu = () => {$('#userMenu').removeClass('d-none');}
const closeUserMenu = () => {$('#userMenu').addClass('d-none');}
const hidePwd = () => {$('#prompts').hide();}
const changePwd = () => {
  $('#prompts').show();
  showAttemptPrompt();
  closeUserMenu();
  locationAttempt.innerHTML = `
    <h2>Change password:</h2>
    <small><b>NB: you will be logged out after updating your password.</b></small>
    <form action="profile" method="post">
      <p class="mb-2">Current Password:</p>
      <input type="password" id="oldPwd" class="form-control" onkeyup="handleOldPwd(this)" required>
      <p class="mb-2">New Password:</p>
      <input type="password" id="newPwd" class="form-control" name="new_pwd" required onkeyup="handleNewPwd()">
      <p class="mb-2">Comfirm Password:</p>
      <input type="password" id="newPwd2" class="form-control" name="new_pwd2" required onkeyup="handleComfirm()">
      <div class="mt-2" id="msg"></div>
      <div class="text-right">
        <button type="button" class="btn btn-primary" onclick="hidePwd()">Cancel</button>&nbsp;&nbsp;
        <button type="submit" class="btn btn-primary" name="submit" id="submit" disabled="true">Submit</button>
      </div>
    </form>
  `;
}
const handleOldPwd = (input) => {
  $.ajax({
    url: 'server',
    method: 'POST',
    data: {old:1,pwd:input.value},
    success: data => {
      if(data != "success"){
        $("#msg").html('<div class="alert alert-danger">Wrong old password</div>');
        $("#submit").attr("disabled","true");
        document.getElementById('newPwd').value = '';
      }else{
        $("#msg").html('');
        document.getElementById('newPwd').focus();
        handleNewPwd();
      }
    }
  });
}
const handleNewPwd = () => {
  const n = document.getElementById('newPwd').value;
  if (n.length < 4) {
    $("#msg").html('<div class="alert alert-danger">New Password is too short</div>');
    $("#submit").attr("disabled","true");
  }else{
    $("#msg").html('');
    // handleComfirm();
  }
}
const handleComfirm = () => {
  const n = document.getElementById('newPwd').value;
  const c = document.getElementById('newPwd2').value;
  if (n != c) {
    $("#msg").html('<div class="alert alert-danger">Passwords do not match, Comfirm new password</div>');
    $("#submit").attr("disabled","true");
  }else{
    $("#msg").html('');
    document.getElementById('submit').removeAttribute('disabled');
  }
}
const closeSideBar = () => {
  sideBar.classList.remove('show-side-bar');
  setTimeout(()=>{sideBarModal.classList.add('d-none')},400);
}
const aboutUs = () => {
  sideBarModal.classList.remove('d-none');
  let content = `
  <h2>About us</h2>
  <p>This is about us tab! use close button above to close this side bar</p>
  <p>This is about us tab! use close button above to close this side bar</p>
  <p>This is about us tab! use close button above to close this side bar</p>
  <br>
  <p>This amazing project was created and designed by Uwizeyimana Liliose,.....,....</p>
  `;
  sideBarContents.innerHTML = content;
  setTimeout(()=>{
    sideBar.classList.add('show-side-bar');
  },10);
}
const contactUs = () => {
  sideBarModal.classList.remove('d-none');
  let content = `
  <h2>Contact us</h2>
  <p>This is contact us tab! use close button above to close this side bar</p>
  <p>Liliose: 078888888</p>
  <p>Email: ...........</p>
  <br>
  <p>Liliose: 078888888</p>
  <p>Email: ...........</p>
  <br>
  <p>Liliose: 078888888</p>
  <p>Email: ...........</p>
  `;
  sideBarContents.innerHTML = content;
  setTimeout(()=>{
    sideBar.classList.add('show-side-bar');
  },10);
}
const helpMe = () => {
  sideBarModal.classList.remove('d-none');
  let content = `
  <h2><i class='fa fa-question-circle'></i> Help</h2>
  <p><b>Below are the steps to follow inorder to run this project correctly</b></p>
  <ol type="1">
    <li>Make sure you have an internet connection and a browser wich supports geolocation api (chrome or fire fox are recommended)</li>
    <li>Create an account if you don't have one and then sign into it</li>
    <li>Allow the browser to access your location</li>
    <li>Choose bank name that you want to know where its ATMs are located</li>
    <li>Use the info provided and make decision!</li>
  </ol>
  <p>Our Contacts will be helpful if you need more info!.</p>
  `;
  sideBarContents.innerHTML = content;
  setTimeout(()=>{
    sideBar.classList.add('show-side-bar');
  },10);
}
//ready
$(document).ready(() => {
  //initialize possible listeners
  if(signupBtn){signupBtn.addEventListener('click',signupClientValidator);}
  if(name){name.addEventListener('keyup',nameInput);}
  if(email){email.addEventListener('keyup',emailInput);}
  if(password){password.addEventListener('keyup',passwordInput);}
  if(password2){password2.addEventListener('keyup',password2Input);}
  if(username){username.addEventListener('keyup',usernameInput);}
  if(loginForm){loginForm.addEventListener('submit',handleLoginForm)}
  if(profilePage){
    handleBgs();
    permissions();
  }
});