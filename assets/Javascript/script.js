
"use script"
const nome = document.getElementById('nome_camp');
const sobNome = document.getElementById('sob_camp');
const genero = document.querySelector('#genero_camp');
const date = document.getElementById('datacamp');
const camposInput = document.querySelectorAll('.campo');
const data = new Date();
let dataAtualizada = data.toLocaleDateString('fr-CA', { day: "numeric", month: "numeric", year: "numeric" });

let msg = document.querySelector('#msg-title');
let contMsg = document.querySelector('#msg');

nome.addEventListener("keypress", blocked);
sobNome.addEventListener("keypress", blocked);
date.setAttribute('max', dataAtualizada);

function blocked(e) {

  var keyCode = (e.keyCode ? e.keyCode : e.which);

  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
  }
}


const MyForm = document.getElementById('my-form');

MyForm.addEventListener('submit', async e => {
  const formData = new FormData(MyForm);
  const checkedInput = [];
  e.preventDefault();

  Array.from(camposInput).forEach(function (event, i) {

    if (!event.value > '') {
      event.classList.add('groupFocus');
    } else {
      checkedInput.push(event.value > '');
    }

    event.addEventListener('click', function (event) {

      if (event.target.classList.contains('groupFocus')) {
        event.target.classList.remove('groupFocus');
      }

    })
  })

  const asck = await fetch('http://localhost/Projeto-Server/assets/PHP/Informacao.php', {
    method: 'POST',
    mode: 'cors',
    body: formData,
  }).then(response => response.json())
    .then(function (data) {

      contMsg.classList.add(`${data.status}`);
      contMsg.style.opacity = '1';
      contMsg.style.top = '3em';
      msg.innerHTML = data.message;

      // nome.classList.add(`${data.status}`);
      // sobNome.classList.add(`${data.status}`);
      // genero.classList.add(`cam${data.status}`);
      // date.classList.add(`cam${data.status}`);

      if (nome.classList.contains('error') && nome.value == '') {
        nome.focus();
      } else if (sobNome.classList.contains('error') && sobNome.value == '') {
        sobNome.focus();
      } else if (genero.classList.contains('camerror') && genero.value == "") {
        genero.focus();
      } else if (date.classList.contains('camerror') && date.value == '') {
        date.focus();
      }

      setTimeout(() => {
        contMsg.style.opacity = '0';
        contMsg.style.top = '0';
        nome.classList.remove('error');
        sobNome.classList.remove('error');
        genero.classList.remove('camerror');
        date.classList.remove('camerror');
      }, 5000)

      if (data.status == 'success') {
        document.getElementById('nome_camp').value = '';
        document.getElementById('sob_camp').value = '';
        document.getElementById('genero_camp').value = '';
        document.getElementById('datacamp').value = '';
        contMsg.classList.remove('error');
      }

    }).catch(function (error) {

      contMsg.classList.add('error');
      contMsg.style.opacity = '1';
      contMsg.style.top = '3em';
      msg.innerHTML = 'Ocorreu um Erro , vamos recarregar a pagina !';
      console.log(error);

      setTimeout(() => {
        window.location.reload()
      }, 8000)

      // setTimeout(() => {
      //   contMsg.style.opacity = '0';
      //   contMsg.style.top = '0';
      // }, 5000)

    })
})