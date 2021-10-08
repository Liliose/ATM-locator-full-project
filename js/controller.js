let bgIntervals = [];
let bgCounter = 0;
const name = document.getElementById('name');
const nameError = document.getElementById('nameError');
const nameCheckMark = document.getElementById('nameCheckMark');
const email = document.getElementById('email');
const emailError = document.getElementById('emailError');
const emailCheckMark = document.getElementById('emailCheckMark');
const username = document.getElementById('username');
const usernameError = document.getElementById('usernameError');
const usernameCheckMark = document.getElementById('usernameCheckMark');
const password = document.getElementById('password');
const passwordError = document.getElementById('passwordError');
const passwordCheckMark = document.getElementById('passwordCheckMark');
const password2 = document.getElementById('password2');
const password2Error = document.getElementById('password2Error');
const password2CheckMark = document.getElementById('password2CheckMark');
const signupBtn = document.getElementById('signupBtn');
const spin = '<span class="spinner-border spinner-border-sm" role="status"></span>';
const loginForm = document.getElementById('loginForm');
const loginPassword = document.getElementById('loginPassword');
const loginUsername = document.getElementById('loginUsername');
const loginBtn = document.getElementById('loginBtn');
const loginError = document.getElementById('loginError');
const profilePage = document.querySelector('.profile');
const locationPrompt = document.getElementById('locationPrompt');
const locationAttempt = document.getElementById('locationAttempt');
const sideBar = document.getElementById('sideBar');
const sideBarModal = document.getElementById('sideBarModal');
const sideBarContents = document.getElementById('sideBarContents');
let attempts = 0, lt = 0, ln = 0, bankName = '', maximumKilometers = 5;
const toRadians = degree => {return degree * Math.PI / 180;}
const distance = (latitude1, longitude1, latitude2, longitude2) => {
  var R = 6371;
  var deltaLatitude = toRadians(latitude2-latitude1);
  var deltaLongitude = toRadians(longitude2-longitude1);
  latitude1 = toRadians(latitude1);
  latitude2 = toRadians(latitude2);
  var a = Math.sin(deltaLatitude/2) *
  Math.sin(deltaLatitude/2) +
  Math.cos(latitude1) *
  Math.cos(latitude2) *
  Math.sin(deltaLongitude/2) *
  Math.sin(deltaLongitude/2);
  var c = 2 * Math.atan2(Math.sqrt(a),
  Math.sqrt(1-a));
  var d = R * c;
  return d;
}


