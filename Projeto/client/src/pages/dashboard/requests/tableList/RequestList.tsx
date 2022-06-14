import sumBy from 'lodash/sumBy';
import { useEffect, useState } from 'react';
import { Link as RouterLink, useNavigate } from 'react-router-dom';
// @mui
import { useTheme } from '@mui/material/styles';
import {
  Box,
  Tab,
  Tabs,
  Card,
  Table,
  Stack,
  Switch,
  Button,
  Tooltip,
  Divider,
  TableBody,
  Container,
  IconButton,
  TableContainer,
  TablePagination,
  FormControlLabel,
} from '@mui/material';
// routes
import { PATH_DASHBOARD } from 'src/routes/paths';
// hooks
import useTabs from 'src/hooks/useTabs';
import useSettings from 'src/hooks/useSettings';
import useTable, { getComparator, emptyRows } from 'src/hooks/useTable';
// components
import Page from 'src/components/Page';
import Label from 'src/components/Label';
import Iconify from 'src/components/Iconify';
import Scrollbar from 'src/components/Scrollbar';
import HeaderBreadcrumbs from 'src/components/HeaderBreadcrumbs';
import {
  TableNoData,
  TableEmptyRows,
  TableHeadCustom,
  TableSelectedActions,
} from 'src/components/table';
import { RequestsTableRow, RequestsTableToolbar } from './list';
import { useDispatch, useSelector } from 'src/redux/store';
import {
  getTransactions,
  deleteTransaction,
  getTransactionsValue,
} from 'src/redux/slices/transaction';
import { useSnackbar } from 'notistack';
import RequestsAnalytic from '../RequestsAnalytic';
import TablePaginationTranslation from '../../../../components/TablePaginationTranslation';

// ----------------------------------------------------------------------

const TABLE_HEAD = [
  { id: 'title', label: 'Titulo', align: 'left' },
  { id: 'value', label: 'Valor', align: 'left' },
  { id: 'category', label: 'Categoria', align: 'left' },
  { id: 'description', label: 'Descrição', align: 'left' },
  { id: 'date', label: 'Data', align: 'center', width: 140 },
  { id: '' },
];

// ----------------------------------------------------------------------

export default function RequestsList() {
  const theme = useTheme();

  const dispatch = useDispatch();

  const { enqueueSnackbar } = useSnackbar();

  const { themeStretch } = useSettings();

  const navigate = useNavigate();

  const { transactions, transactionsValue, count } = useSelector((state) => state.transaction);

  console.log(transactions);

  const summary = transactionsValue.reduce(
    (accumulator, transaction) => {
      if (transaction.category === 'Saída') {
        accumulator.exit += Number(transaction.value);
        accumulator.total += Number(transaction.value);
      } else {
        accumulator.deposit += Number(transaction.value);
        accumulator.total -= Number(transaction.value);
      }

      return accumulator;
    },
    {
      exit: 0,
      deposit: 0,
      total: 0,
    }
  );

  const investments = transactionsValue.reduce(
    (accumulator, transaction) => {
      if (transaction.category === 'Investimento') {
        accumulator.investments += Number(transaction.value);
      }
      return accumulator;
    },
    {
      investments: 0,
    }
  );

  let saida = 0;
  let investimentos = 0;
  let receitas = 0;
  if (transactions) {
    saida = transactions.filter((transaction) => transaction.category === 'Saída').length;
    investimentos = transactions.filter(
      (transaction) => transaction.category === 'Investimento'
    ).length;
    receitas = transactions.filter((transaction) => transaction.category === 'Entrada').length;
  }

  const {
    page,
    order,
    orderBy,
    rowsPerPage,
    setPage,
    //
    selected,
    onSelectRow,
    onSelectAllRows,
    //
    onSort,
    onChangePage,
    onChangeRowsPerPage,
  } = useTable({ defaultOrderBy: 'createDate' });

  const [filterName, setFilterName] = useState('');

  const [filterService, setFilterService] = useState('all');

  const [filterStartDate, setFilterStartDate] = useState<Date | null>(null);

  const [filterEndDate, setFilterEndDate] = useState<Date | null>(null);

  const { currentTab: filterStatus, onChangeTab: onFilterStatus } = useTabs('all');

  const handleFilterName = (filterName: string) => {
    setFilterName(filterName);
    setPage(0);
  };

  const handleFilterService = (event: React.ChangeEvent<HTMLInputElement>) => {
    setFilterService(event.target.value);
  };

  const handleDeleteRow = async (id: string) => {
    await dispatch(deleteTransaction(id));
    enqueueSnackbar('Transação deletada com sucesso', { variant: 'success' });

    const calc = Math.ceil((count - 1) / rowsPerPage) - 1;

    if (page > calc) {
      setPage(calc);
    } else {
      dispatch(
        getTransactions({
          step: rowsPerPage,
          page: page,
          filterOrder: TABS.filter((tab) => tab.value === filterStatus).reduce(
            (obj, item) =>
              Object.assign(obj, { filterName: item.filterName, filterValue: item.filterValue }),
            {}
          ),
          filterName,
          order,
          orderBy,
        })
      );
    }
  };

  const handleEditRow = (id: string) => {
    navigate(PATH_DASHBOARD.requests.edit(id));
  };

  const handleViewRow = (id: string) => {
    navigate(PATH_DASHBOARD.requests.view(id));
  };

  const isNotFound = !transactions;

  const TABS = [
    {
      value: 'all',
      label: 'Todas',
      filterName: 'category',
      filterValue: undefined,
      color: 'info',
      count: count,
    },
    {
      value: 'appetizer',
      label: 'Receitas',
      filterName: 'category',
      filterValue: 'Entrada',
      color: 'success',
      count: receitas,
    },
    {
      value: 'without',
      label: 'Despesas',
      filterName: 'category',
      filterValue: 'Saída',
      color: 'error',
      count: saida,
    },
    {
      value: 'investments',
      label: 'Investimentos',
      filterName: 'category',
      filterValue: 'Investimento',
      color: 'primary',
      count: investimentos,
    },
  ] as const;

  useEffect(() => {
    dispatch(
      getTransactionsValue({
        step: rowsPerPage,
        page: page,
        filterOrder: TABS.filter((tab) => tab.value === filterStatus).reduce(
          (obj, item) =>
            Object.assign(obj, { filterName: item.filterName, filterValue: item.filterValue }),
          {}
        ),
        filterName,
        order,
        orderBy,
      })
    );
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  useEffect(() => {
    dispatch(
      getTransactions({
        step: rowsPerPage,
        page: page,
        filterOrder: TABS.filter((tab) => tab.value === filterStatus).reduce(
          (obj, item) =>
            Object.assign(obj, { filterName: item.filterName, filterValue: item.filterValue }),
          {}
        ),
        filterName,
        order,
        orderBy,
      })
    );
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [rowsPerPage, page, filterName, filterStatus]);

  return (
    <Page title="Controle Financeiro">
      <Container maxWidth={themeStretch ? false : 'lg'}>
        <Button
          sx={{ marginBottom: 2 }}
          variant="outlined"
          component={RouterLink}
          to={PATH_DASHBOARD.requests.new}
        >
          Nova transação
        </Button>

        <Stack
          direction="row"
          divider={<Divider orientation="vertical" flexItem sx={{ borderStyle: 'dashed' }} />}
          sx={{ py: 2 }}
        >
          <RequestsAnalytic
            title="Total"
            quantity={summary.deposit - summary.exit}
            icon="ic:round-receipt"
            color={theme.palette.info.main}
          />
          <RequestsAnalytic
            title="Receitas"
            quantity={summary.deposit}
            icon="eva:checkmark-circle-2-fill"
            color={theme.palette.success.main}
          />
          <RequestsAnalytic
            title="Despesas"
            quantity={summary.exit}
            icon="eva:clock-fill"
            color={theme.palette.error.main}
          />

          <RequestsAnalytic
            title="Investimentos"
            quantity={investments.investments}
            icon="eva:clock-fill"
            color={theme.palette.grey[900]}
          />
        </Stack>

        <Card>
          <Tabs
            allowScrollButtonsMobile
            variant="scrollable"
            scrollButtons="auto"
            value={filterStatus}
            onChange={onFilterStatus}
            sx={{ px: 2, bgcolor: 'background.neutral' }}
          >
            {TABS.map((tab) => (
              <Tab disableRipple key={tab.value} value={tab.value} label={tab.label} />
            ))}
          </Tabs>

          <Divider />

          <RequestsTableToolbar
            filterName={filterName}
            filterService={filterService}
            filterStartDate={filterStartDate}
            filterEndDate={filterEndDate}
            onFilterName={handleFilterName}
            onFilterService={handleFilterService}
            onFilterStartDate={(newValue) => {
              setFilterStartDate(newValue);
            }}
            onFilterEndDate={(newValue) => {
              setFilterEndDate(newValue);
            }}
          />

          <Scrollbar>
            <TableContainer sx={{ minWidth: 800, position: 'relative' }}>
              <Table size={'small'}>
                <TableHeadCustom
                  order={order}
                  orderBy={orderBy}
                  headLabel={TABLE_HEAD}
                  rowCount={count}
                  numSelected={selected.length}
                  onSort={onSort}
                  onSelectAllRows={(checked) =>
                    onSelectAllRows(
                      checked,
                      transactions.map((row) => row.id)
                    )
                  }
                />

                <TableBody>
                  {transactions.map((row) => (
                    <RequestsTableRow
                      key={row.id}
                      row={row}
                      selected={selected.includes(row.id)}
                      onSelectRow={() => onSelectRow(row.id)}
                      onViewRow={() => handleViewRow(row.id)}
                      onEditRow={() => handleEditRow(row.id)}
                      onDeleteRow={() => handleDeleteRow(row.id)}
                    />
                  ))}

                  <TableEmptyRows emptyRows={emptyRows(page, rowsPerPage, count)} />

                  <TableNoData isNotFound={isNotFound} />
                </TableBody>
              </Table>
            </TableContainer>
          </Scrollbar>

          <Box sx={{ position: 'relative' }}>
            <TablePaginationTranslation
              rowsPerPageOptions={[5, 10, 25]}
              component="div"
              count={count}
              rowsPerPage={rowsPerPage}
              page={page}
              onPageChange={onChangePage}
              onRowsPerPageChange={onChangeRowsPerPage}
            />
          </Box>
        </Card>
      </Container>
    </Page>
  );
}

// ----------------------------------------------------------------------
