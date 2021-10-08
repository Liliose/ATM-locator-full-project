$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
const spin = '<span class="spinner-border spinner-border-sm" role="status"></span>&nbsp;';
const popUp = document.getElementById('popUp');
const popUpContents = document.getElementById('popUpContents');
const messages = document.getElementById('messages');
const lt = document.getElementById('lt');
const ln = document.getElementById('ln');
const manualTab = document.getElementById('manualTab');
const automaticTab = document.getElementById('automaticTab');
const automaticRegistration = document.getElementById('automaticRegistration');
const manualRegistration = document.getElementById('manualRegistration');
let attempts = 1;
const remove = (id,type) => {
  if(confirm('Do you want to perform this action?')){
    if(type == 'user'){
      $.ajax({
        url: 'server',
        method: 'POST',
        data: {removeUser:1,id},
        success: () => {
          window.location = 'admin/users';
        }
      })
    }
    if(type == 'atm'){
      $.ajax({
        url: 'server',
        method: 'POST',
        data: {removeAtm:1,id},
        success: () => {
          window.location = 'admin/atms';
        }
      })
    }
    if(type == 'bank'){
      $.ajax({
        url: 'server',
        method: 'POST',
        data: {removeBank:1,id},
        success: () => {
          window.location = 'admin/banks';
        }
      })
    }
  }
}
const problemFixed = atm => {
  $.ajax({
    url: 'server',
    method: 'POST',
    data: {problemFixed:1,atm},
    success: () => {
      window.location = 'admin/problems';
    }
  });
}
const closePopUp = () => {
 popUp.classList.add('d-none');
}
const editAtm = id => {
  popUpContents.innerHTML = "<div class='centered-content mb-3'><div class='loader'></div></div>";
  popUp.classList.remove('d-none');
  $.ajax({
    url: 'server',
    method: 'POST',
    data: {editAtm:1,id},
    success: data => {
      popUpContents.innerHTML = data;
    }
  });
}
function handleProblem(decision) {
  const problemContainer = document.getElementById('problemContainer');
  const problem = document.getElementById('problem');
  if(decision.value == 'Yes'){
    problemContainer.classList.add('d-none');
    problem.removeAttribute('required');
  }else{
    problemContainer.classList.remove('d-none');
    problem.setAttribute('required','');
    problem.focus();
  }
}
const permissions = () => {
  navigator.permissions.query({name:'geolocation'}).then(function(result) {
    if (result.state == 'granted') {
      report(result.state);
      messages.innerHTML = "<div class='alert alert-warning'>"+ spin +"Waiting for location...</div>";
      getLocation();
    } else if (result.state == 'prompt') {
      report(result.state);
      messages.innerHTML = "<div class='alert alert-warning'>"+ spin +"Waiting for location...</div>";
      getLocation();
    } else if (result.state == 'denied') {
      report(result.state);
      messages.innerHTML = "<div class='alert alert-danger'>You denied us to access your location, change this from your browser settings and try again later.</div>";
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
  }else {
    messages.innerHTML = "<div class='alert alert-danger'>Something went wrong while accessing your location, try again later!</div>";
  }
}
const showPosition = position => {
  messages.innerHTML = '<button type="submit" name="register" class="btn btn-success">Register ATM</button>';
  lt.value = position.coords.latitude;
  ln.value = position.coords.longitude;
  console.log("ln and lt was found!");
}
const handlePosition = err => {
  switch(err.code){
    case 0:
      messages.innerHTML = "<div class='alert alert-danger'>Something went wrong while accessing your location, try again later!</div>";
    break;
    case 1:
      messages.innerHTML = "<div class='alert alert-danger'>You denied us to access your location, change this from your browser settings and try again later.</div>";
    break;
    case 2:
      messages.innerHTML = "<div class='alert alert-danger'>Your browser failed to determine your location, use different browser (chrome or fire fox are recommended)</div>";
    break;
    case 3:
      if(attempts < 2){
        getLocation();
        setTimeout(() => {
          if(attempts == 2){
            messages.innerHTML = "<div class='alert alert-danger'>"+ spin +"Still trying...</div>";
          }else{
            messages.innerHTML = "<div class='alert alert-warning'>"+ spin +"We are still trying to know your loction...</div>";
          }
        },1000);
        attempts += 1;
      }else{
        messages.innerHTML = "<div class='alert alert-danger'>We tried more than once but failed, check your connection or use different browser (chrome or firefox are recommended).</div>";
      }
    break;
  }
}
const handleManualTab = () => {
  automaticTab.classList.remove('tab-active');
  manualTab.classList.add('tab-active');
  $('#automaticRegistration').hide();
  $('#manualRegistration').fadeIn('slow');
}
const handleAutomaticTab = () => {
  manualTab.classList.remove('tab-active');
  automaticTab.classList.add('tab-active');
  $('#manualRegistration').hide();
  $('#automaticRegistration').fadeIn('slow');
}
function automaticReg(){
  ln.removeAttribute('disabled');
  lt.removeAttribute('disabled');
}
const handleBankName = input => {
  $.ajax({
    url: 'server',
    method: 'POST',
    data: {input:1,name:input.value},
    success: data => {
      $('#msg').html(data);
    }
  })
}
const handleBankName2 = input => {
  $.ajax({
    url: 'server',
    method: 'POST',
    data: {input:1,name:input.value},
    success: data => {
      $('#msg2').html(data);
      if(data.length > 0){
        document.getElementById('update').setAttribute('disabled','true');
      }else{
        document.getElementById('update').removeAttribute('disabled');
      }
    }
  })
}
const saveBank = btn => {
  btn.innerHTML = spin + ' Saving...'
  const data = {
    saveBank: 1,
    bankName: document.getElementById('bankName').value
  }
  $.ajax({
    url: 'server',
    method: 'POST',
    data,
    success: data => {
      if(data != 'success'){
        $('#msg').html(data);
        btn.innerHTML = "Save";
      }else{
        window.location = "admin/banks";
      }
    }
  })
}
const editBank = id => {
  popUpContents.innerHTML = "<div class='centered-content mb-3'><div class='loader'></div></div>";
  popUp.classList.remove('d-none');
  const data = {
    editBank: 1,
    id
  }
  $.ajax({
    url: 'server',
    method: 'POST',
    data,
    success: data => {
      popUpContents.innerHTML = data;
    }
  });
}
function handleFilter(option){
  const data = {
    filter: 1,
    option:option.value
  }
  $.ajax({
    url: 'server',
    method: 'POST',
    data,
    success: data => {
      $('#atms').html(data);
    }
  });
}
$(document).ready(() => {
  if(ln && lt){permissions();}
  if(manualTab){
    $('#manualRegistration').hide();
    manualTab.addEventListener('click',handleManualTab);
    automaticTab.addEventListener('click', handleAutomaticTab);
  }
});