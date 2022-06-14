// @mui
import { Container } from '@mui/material';
// routes
import { PATH_DASHBOARD } from 'src/routes/paths';
// hooks
import useSettings from 'src/hooks/useSettings';
// components
import Page from 'src/components/Page';
import HeaderBreadcrumbs from 'src/components/HeaderBreadcrumbs';
// sections
import RequestNewEditForm from './newEditForm';
import { useDispatch } from '../../../../redux/store';
import { useLocation, useParams } from 'react-router';
import { useEffect } from 'react';
import { clearTransaction, getTransaction } from '../../../../redux/slices/transaction';

// ----------------------------------------------------------------------

export default function RequestsCreate() {
  const { themeStretch } = useSettings();

  const dispatch = useDispatch();

  const { pathname } = useLocation();

  const { id } = useParams();

  const isEdit = pathname.includes('edit');

  useEffect(() => {
    if (id) {
      dispatch(getTransaction(id));
    }
    return () => {
      dispatch(clearTransaction());
    };
  }, [dispatch, id]);

  return (
    <Page title="Controle financeiro">
      <Container maxWidth={themeStretch ? false : 'lg'}>
        <HeaderBreadcrumbs
          heading="Controle financeiro"
          links={[{ name: 'transações', href: PATH_DASHBOARD.requests.list }]}
        />

        <RequestNewEditForm isEdit={isEdit} />
      </Container>
    </Page>
  );
}
