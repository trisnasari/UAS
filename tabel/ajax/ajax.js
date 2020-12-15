const container = document.querySelector('.container');
const keyword = document.getElementById('keyword');

keyword.addEventListener('keyup', ()=>{

  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = ()=>{
    if( xhr.readyState == 4 && xhr.status == 200 ){
      container.innerHTML = xhr.responseText;
    }
  }

  xhr.open('GET','ajax/dataBuku.php?keyword='+ keyword.value,true);
  xhr.send();







});
