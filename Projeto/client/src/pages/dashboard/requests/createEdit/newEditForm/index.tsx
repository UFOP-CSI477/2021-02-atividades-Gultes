import * as Yup from 'yup';
import { useCallback, useEffect, useMemo } from 'react';
import { useSnackbar } from 'notistack';
import { useNavigate } from 'react-router-dom';
// form
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
// @mui
import { LoadingButton } from '@mui/lab';
import { Box, Card, Grid, Stack, TextField, Typography } from '@mui/material';
import { useFormik, Form, FormikProvider } from 'formik';
// utils
import { fData } from '../../../../../utils/formatNumber';
// routes
import { PATH_DASHBOARD } from '../../../../../routes/paths';

import { useDispatch, useSelector } from '../../../../../redux/store';
import { createTransaction, updateTransaction } from '../../../../../redux/slices/transaction';
import useAuth from '../../../../../hooks/useAuth';

// ----------------------------------------------------------------------

interface Transaction {
  title: string;
  value: string;
  category: string;
  description: string;
}

type FormValuesProps = Transaction;

type Props = {
  isEdit: boolean;
};

export default function RequestNewEditForm({ isEdit }: Props) {
  const navigate = useNavigate();

  const { user } = useAuth();

  const dispatch = useDispatch();

  const { transaction } = useSelector((state) => state.transaction);

  const { enqueueSnackbar } = useSnackbar();

  const NewUserSchema = Yup.object().shape({
    title: Yup.string().required('Campo requirido'),
    value: Yup.string().required('Campo requirido'),
    category: Yup.string().required('Campo requirido'),
    description: Yup.string().required('Campo requirido'),
  });

  const formik = useFormik({
    enableReinitialize: true,
    initialValues: {
      userId: user?.id,
      id: transaction?.id || '',
      title: transaction?.title || '',
      value: transaction?.value || '',
      category: transaction?.category || '',
      description: transaction?.description || '',
    },

    validationSchema: NewUserSchema,
    onSubmit: async (values, { resetForm }) => {
      const transaction = {
        userId: values.userId,
        title: values.title,
        value: values.value,
        category: values.category,
        description: values.description,
      };

      try {
        isEdit
          ? dispatch(updateTransaction(values.id, transaction))
          : dispatch(createTransaction(transaction));
        enqueueSnackbar(
          !isEdit ? 'Transação criada com sucesso!' : 'Transação atualizada com sucesso!'
        );
        resetForm();
        navigate(PATH_DASHBOARD.requests.list);
      } catch (error) {
        enqueueSnackbar(
          !isEdit
            ? `Erro ao criar transação. ${error?.message}`
            : `Erro ao atualizar transação. ${error?.message}`,
          { variant: 'error' }
        );
        resetForm();
      }
    },
  });

  const { errors, touched, isSubmitting, handleSubmit, getFieldProps, isValid, dirty, values } =
    formik;

  return (
    <FormikProvider value={formik}>
      <Form autoComplete="off" noValidate onSubmit={handleSubmit}>
        <Card sx={{ p: 3 }}>
          <Box
            sx={{
              display: 'grid',
              columnGap: 2,
              rowGap: 3,
              gridTemplateColumns: { xs: 'repeat(1, 1fr)', sm: 'repeat(2, 1fr)' },
            }}
          >
            <TextField
              label="Titulo"
              {...getFieldProps('title')}
              error={Boolean(touched.title && errors.title)}
              helperText={touched.title && errors.title}
            />

            <TextField
              label="Valor"
              {...getFieldProps('value')}
              error={Boolean(touched.value && errors.value)}
              helperText={touched.value && errors.value}
            />

            <TextField
              select
              fullWidth
              label="Categoria"
              placeholder="Categoria"
              {...getFieldProps('category')}
              SelectProps={{ native: true }}
              error={Boolean(touched.category && errors.category)}
              helperText={touched.category && errors.category}
            >
              <option>{''}</option>
              {[
                { id: 1, value: 'Entrada' },
                { id: 2, value: 'Saída' },
                { id: 3, value: 'Investimento' },
              ].map((option) => (
                <option key={option.id} value={option.value}>
                  {option.value}
                </option>
              ))}
            </TextField>

            <TextField
              label="Descrição"
              {...getFieldProps('description')}
              error={Boolean(touched.description && errors.description)}
              helperText={touched.description && errors.description}
            />
          </Box>

          <Stack alignItems="flex-end" sx={{ mt: 3 }}>
            <LoadingButton type="submit" variant="outlined" loading={isSubmitting}>
              {!isEdit ? 'Criar transação' : 'Atualizar transação'}
            </LoadingButton>
          </Stack>
        </Card>
      </Form>
    </FormikProvider>
  );
}
