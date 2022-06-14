import numeral from 'numeral';

// ----------------------------------------------------------------------

export function fCurrency(number: number | string) {
  return `R$ ${number.toLocaleString('pt-BR', {
    maximumFractionDigits: 2,
    minimumFractionDigits: 2,
  })}`;
}

export function fPercent(number: number) {
  return numeral(number / 100).format('0.0%');
}

export function fNumber(number: string | number) {
  return numeral(number).format();
}

export function fShortenNumber(number: string | number) {
  return numeral(number).format('0.00a').replace('.00', '');
}

export function fData(number: string | number) {
  return numeral(number).format('0.0 b');
}
