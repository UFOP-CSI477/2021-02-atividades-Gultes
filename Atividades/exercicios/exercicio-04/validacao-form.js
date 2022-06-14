"use strict";

function validateForm() {
  const $nameInput = document.querySelector("#name");
  const $ageInput = document.querySelector("#age");
  const $telInput = document.querySelector("#tel");
  const $cepInput = document.querySelector("#cep");

  const inputList = [$nameInput, $ageInput, $telInput, $cepInput];
  let valid = true;
  inputList.forEach(function validateInput(input) {
    if (input.value.length === 0) valid = false;
  });
  const $resultado = document.querySelector(".resultado");

  $resultado.textContent = valid ? "Formulário válido" : "Formulário inválido";
}
