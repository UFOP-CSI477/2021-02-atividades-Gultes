let transactionNuM = 0;
let entries = [];

function Transaction(id, keyType, key, value, type, date, bank) {
    this.id = id;
    this.keyType = keyType;
    this.key = key;
    this.value = value;
    this.type = type;
    this.date = date;
    this.bank = bank;
}

(async function () {
    const $addButton = document.querySelector("#add");
    const banks = await getBanks();
    addEventListenerInAddButton($addButton, banks);
})();

function addEventListenerInAddButton($addButton, banks) {
    $addButton.addEventListener("click", () => {
        const $contentEntries = document.querySelector(".content-entries");
        $contentEntries.appendChild(getTransactionsCard());
        const $select = document.querySelector(
            `.bank-select-class-${transactionNuM}`
        );

        banks.forEach(function (bank) {
            const $option = document.createElement("option");
            $option.value = bank.fullName;
            $option.innerText = bank.fullName;
            $select.appendChild($option);
        });
    });
}

async function getBanks() {
    return await fetch("https://brasilapi.com.br/api/banks/v1")
        .then((response) => response.json())
        .then((data) => data);
}

function getTransactionsCard() {
    transactionNuM++;
    const $card = document.createElement("div");
    $card.classList.add("card");
    $card.classList.add(`trans-${transactionNuM}`);
    $card.innerHTML = `
    <div class="card-header">Trânsferencia</div>
    <div class="card-body">
      <div class="form-group type-div">
        <label>Tipo de chave:</label>
        <div class="form-group form-check">
          <input
            type="radio"
            class="form-check-input"
            id="cpf-${transactionNuM}"
            name="type-${transactionNuM}"
            value="cpf"
            checked="checked"
          />
          <label class="form-ckeck-label" for="cpf-${transactionNuM}">
            CPF
          </label>
        </div>
        <div class="form-group form-check">
          <input
            class="form-check-input"
            type="radio"
            id="cnpj-${transactionNuM}"
            name="type-${transactionNuM}"
            value="cnpj"
          />
          <label class="form-ckeck-label" for="cnpj-${transactionNuM}">
            CNPJ
          </label>
        </div>
        <div class="form-group form-check">
          <input
            class="form-check-input"
            type="radio"
            id="email-${transactionNuM}"
            name="type-${transactionNuM}"
            value="email"
          />
          <label class="form-ckeck-label" for="email-${transactionNuM}">
            E-mail
          </label>
        </div>
        <div class="form-group form-check">
          <input
            class="form-check-input"
            type="radio"
            id="number-${transactionNuM}"
            name="type-${transactionNuM}"
            value="number"
          />
          <label class="form-ckeck-label" for="number-${transactionNuM}">
            Número de celular
          </label>
        </div>
        <div class="form-group form-check">
          <input
            class="form-check-input"
            type="radio"
            id="random-${transactionNuM}"
            name="type-${transactionNuM}"
            value="random"
          />
          <label class="form-ckeck-label" for="random-${transactionNuM}">
            Chave aleatória
          </label>
        </div>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
          Chave
        </span>
        <input
          value="chave"
          type="text"
          class="form-control input-${transactionNuM}"
          placeholder="Digite aqui sua chave"
        />
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
          R$
        </span>
        <input min="0" value="0" type="number" class="form-control value-${transactionNuM}" placeholder="Valor" />
        <label class="input-group-text" for="type-transf">
          Tipo
        </label>
        <select class="form-select select-${transactionNuM}" id="type-transf">
          <option value="Envio">Envio</option>
          <option value="Recebimento">Recebimento</option>
        </select>
        <span class="input-group-text">Data</span>
        <input type="date" class="form-control date-picker" placeholder="Valor" />
      </div>

      <div class="input-group mb-3">
        <label class="input-group-text" for="bank-select-${transactionNuM}">
          Banco
        </label>
        <select class="form-select bank-select-class-${transactionNuM}" name="bank-select-${transactionNuM}">
        </select>
      </div>
    </div>

    <div class="card-footer text-muted">
      <button class="btn btn-success" data-js="btn-save-${transactionNuM}">
        Salvar
      </button>
      <button  class="btn btn-danger" data-js="btn-delete-${transactionNuM}">
        Excluir
      </button>
    </div>
`;

    salveTransaction($card);
    removeTransaction($card);

    $card.querySelector(".date-picker").valueAsDate = new Date();
    return $card;
}

function salveTransaction($card) {
    $card
        .querySelector(`[data-js=btn-save-${transactionNuM}]`)
        .addEventListener("click", (e) => {
            const transaction = e.target.getAttribute("data-js").split("-")[2];
            const typeOfKey = $card.querySelector(
                `[name=type-${transaction}]:checked`
            ).value;
            const key = $card.querySelector(`.input-${transaction}`).value;
            const typeOfTransfer = $card.querySelector(
                `.select-${transaction}`
            ).value;
            const bank = $card.querySelector(
                `.bank-select-class-${transaction}`
            ).value;
            const value = $card.querySelector(`.value-${transaction}`).value;
            const date = new Date($card.querySelector(`.date-picker`).value);
            entries.push(
                new Transaction(
                    transaction,
                    typeOfKey,
                    key,
                    value,
                    typeOfTransfer,
                    date,
                    bank
                )
            );

            const $button = $card.querySelector(".btn-success");
            $cardFooter = $card.querySelector(".card-footer");
            $cardFooter.removeChild($button);
        });
}

function removeTransaction($card) {
    $card
        .querySelector(`[data-js=btn-delete-${transactionNuM}]`)
        .addEventListener("click", (e) => {
            const transaction = e.target.getAttribute("data-js").split("-")[2];
            const $entries = document.querySelector(".content-entries");

            $entries.removeChild($card);

            entries = entries.filter((entry) => entry.id !== transaction);
        });
}

function getTransactionsToShow() {
    const $modalInvited = document.querySelector(".invited");
    const $modalReceived = document.querySelector(".received");
    const $total = document.querySelector(".total");
    removeChildElement($modalInvited);
    removeChildElement($modalReceived);
    removeChildElement($total);

    let totalInvited = 0;
    let totalReceived = 0;

    const invited = entries.filter((entry) => entry.type === "Envio");
    const received = entries.filter((entry) => entry.type === "Recebimento");

    invited.forEach((entry) => {
        totalInvited = addInfos($modalInvited, totalInvited, entry);
    });

    received.forEach((entry) => {
        totalReceived = addInfos($modalReceived, totalReceived, entry);
    });

    addTotalCard($modalInvited, "bg-danger", "total-invited", totalInvited);
    addTotalCard($modalReceived, "bg-success", "total-received", totalReceived);

    const totalValue = totalReceived - totalInvited;

    const $pTotalValue = document.createElement("p");
    $pTotalValue.classList.add("element");

    if (totalValue >= 0) $pTotalValue.classList.add("bg-success");
    else $pTotalValue.classList.add("bg-danger");

    $pTotalValue.classList.add("total-received");
    $pTotalValue.textContent = `R$ ${totalValue}`;
    $total.appendChild($pTotalValue);
}

function addTotalCard($modal, typeClassStyle, classElement, total) {
    const $p = document.createElement("p");
    $p.classList.add("element");
    $p.classList.add(typeClassStyle);
    $p.classList.add(classElement);
    $p.textContent = `R$ ${total}`;
    $modal.appendChild($p);
}

function addInfos($modal, total, entry) {
    const $p = document.createElement("p");
    total += Number(entry.value);
    $p.classList.add("element");
    $p.classList.add("bg-primary");
    $p.textContent = `R$ ${entry.value}`;
    $modal.appendChild($p);
    return total;
}

function removeChildElement($element) {
    while ($element.lastElementChild) {
        $element.removeChild($element.lastElementChild);
    }
}
