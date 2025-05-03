var btn_diva =document.getElementById("btn_diva");
var btn_divb =document.getElementById("btn_divb");
var btn_divc =document.getElementById("btn_divc");
var btn_divd =document.getElementById("btn_divd");
var btn_dive =document.getElementById("btn_dive");
var diva =document.getElementById("diva");
var divb =document.getElementById("divb");
var divc =document.getElementById("divc");
var divd =document.getElementById("divd");
var dive =document.getElementById("dive");


btn_diva.addEventListener('click', ()=>{
 diva.style.display = 'block';
  divb.style.display = 'none';
  divc.style.display = 'none';
  divd.style.display = 'none';
  dive.style.display = 'none';
});

btn_divb.addEventListener('click', ()=>{
 diva.style.display = 'none';
  divb.style.display = 'block';
  divc.style.display = 'none';
  divd.style.display = 'none';
  dive.style.display = 'none';
});

btn_divc.addEventListener('click', ()=>{
 diva.style.display = 'none';
  divb.style.display = 'none';
  divc.style.display = 'block';
  divd.style.display = 'none';
  dive.style.display = 'none';
});

btn_divd.addEventListener('click', ()=>{
 diva.style.display = 'none';
  divb.style.display = 'none';
  divc.style.display = 'none';
  divd.style.display = 'block';
  dive.style.display = 'none';
});

btn_dive.addEventListener('click', ()=>{
 diva.style.display = 'none';
  divb.style.display = 'none';
  divc.style.display = 'none';
  divd.style.display = 'none';
  dive.style.display = 'block';
});
