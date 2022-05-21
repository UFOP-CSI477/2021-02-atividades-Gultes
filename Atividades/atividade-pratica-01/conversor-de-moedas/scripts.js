const BASE_URL = "https://economia.awesomeapi.com.br/json/daily/";
let chart = undefined;
(async function () {
  convertAction(() => {
    return getHTMLValues();
  });
})();

function convertAction(callback) {
  document.querySelector("#btn-converter").addEventListener("click", callback);
}

async function getHTMLValues() {
  const $inputAmount = document.querySelector("input");
  const $toSelect = document.querySelector("#select-1");
  const $fromSelect = document.querySelector("#select-2");
  const $p = document.querySelector(".result-p");

  if ($toSelect.value === $fromSelect.value) {
    $p.textContent = `O valor de ${$inputAmount.value} ${
      $toSelect.options[$toSelect.selectedIndex].textContent
    } em ${$fromSelect.options[$fromSelect.selectedIndex].textContent} é de ${
      $inputAmount.value
    }`;
    return;
  }

  const value = await convertCurrency(
    $inputAmount.value,
    $fromSelect.value,
    $toSelect.value
  );
  await getGraph($fromSelect.value, $toSelect.value);
  $p.textContent = `O valor de ${$inputAmount.value} ${
    $toSelect.options[$toSelect.selectedIndex].textContent
  } em ${
    $fromSelect.options[$fromSelect.selectedIndex].textContent
  } é de ${value.toFixed(2)}`;
}

async function convertCurrency(amount, from, to) {
  const response = await (await fetch(`${BASE_URL}${to}-${from}`)).json();
  const data = response[0];
  const rate = data.high;
  return amount * rate;
}

async function getGraph(from, to) {
  if (chart) {
    chart.destroy();
  }
  const response = await (await fetch(`${BASE_URL}${to}-${from}/7`)).json();

  const ctx = document.getElementById("myChart").getContext("2d");

  const labels = [...Array(7)]
    .map((_, i) => {
      const dateChart = new Date();
      dateChart.setDate(dateChart.getDate() - i);
      return dateChart.toLocaleDateString("pt-BR");
    })
    .reverse();
  const data = {
    labels: labels,
    datasets: [
      {
        label: `Contação do nos ultimos 7 dias`,
        data: response.map((item) => item.high).reverse(),
        fill: false,
        borderColor: "rgb(75, 192, 192)",
        tension: 0.1,
      },
    ],
  };
  chart = new Chart(ctx, {
    type: "line",
    data,

    options: {
      scales: {
        x: {
          ticks: {
            maxRotation: 30,
            minRotation: 30,
          },
        },
      },
    },
  });
  console.log(response);
}
