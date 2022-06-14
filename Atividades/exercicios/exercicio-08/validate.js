(function () {
  const $nameInput = document.querySelector("#name");
  const $unInput = document.querySelector("#un");
  const $form = document.querySelector(".type-div");

  $form.addEventListener("submit", (e) => {
    if ($nameInput.value.length === 0 || $unInput.value.length === 0) {
      e.preventDefault();
      addAlertP("Preencha todos os campos");
    } else if ($nameInput.value.length > 100 || $unInput.value.length > 3) {
      e.preventDefault();
      addAlertP("Tamanho fora do limite!");
    }
  });
})();

function addAlertP(text) {
  const $alertP = document.createElement("p");
  $alertP.innerHTML = text;
  const $cardBody = document.querySelector(".card-body");
  $cardBody.appendChild($alertP);
}
