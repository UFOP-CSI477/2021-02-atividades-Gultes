import { TablePagination } from '@mui/material';
type Props = {
  from: number;
  to: number;
  count: number;
};

export default function TablePaginationTranslation({ ...other }: any) {
  const labelRowsPerPage = 'Linhas por página:';
  const labelDisplayedRows = ({ from, to, count }: Props) =>
    `${from}-${to} de ${count !== -1 ? count : `mais de ${to}`}`;
  return (
    <TablePagination
      labelRowsPerPage={labelRowsPerPage}
      labelDisplayedRows={labelDisplayedRows}
      {...other}
    />
  );
}
