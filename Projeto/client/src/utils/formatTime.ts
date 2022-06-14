/* eslint-disable import/no-duplicates */
import { format, getTime, formatDistanceToNow } from 'date-fns';
import ptBR from 'date-fns/locale/pt-BR';

// ----------------------------------------------------------------------

export function fDate(date: Date | string | number) {
  return format(new Date(date), 'dd MMMM yyyy', { locale: ptBR });
}
