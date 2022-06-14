import { createSlice } from '@reduxjs/toolkit';
// utils
import axios from '../../utils/axios';
//
import { dispatch } from '../store';

// ----------------------------------------------------------------------

interface transactionProps {
  created_at: string;
  id: string;
  title: string;
  value: string;
  category: string;
  description: string;
  avatarUrl: string;
}

type transactionState = {
  isLoading: boolean;
  error: Error | string | null;
  sortBy: string | null;
  transaction: transactionProps | null;
  transactions: transactionProps[];
  transactionsValue: transactionProps[];
  count: number;
};

const initialState: transactionState = {
  isLoading: false,
  error: null,
  sortBy: null,
  count: 0,
  transaction: null,
  transactions: [],
  transactionsValue: [],
};

const slice = createSlice({
  name: 'transaction',
  initialState,
  reducers: {
    // START LOADING
    startLoading(state) {
      state.isLoading = true;
    },

    // HAS ERROR
    hasError(state, action) {
      state.isLoading = false;
      state.error = action.payload;
    },

    getTransactionsSuccess(state, action) {
      state.isLoading = false;
      state.transactions = action.payload.items;
      state.count = action.payload.count;
    },

    getTransactionsValueSuccess(state, action) {
      state.isLoading = false;
      state.transactionsValue = action.payload.items;
    },

    getTransactionSuccess(state, action) {
      state.isLoading = false;
      state.transaction = action.payload;
    },

    clearTransaction(state) {
      state.transaction = null;
    },

    sortByTransaction(state, action) {
      state.sortBy = action.payload;
    },

    createTransactionSuccess(state, action) {
      state.isLoading = false;
      state.transactions = [...state.transactions, action.payload];
    },

    deleteTransactionSuccess(state, action) {
      state.isLoading = false;
      const transactions = state.transactions.filter((order: any) => order.id !== action.payload);
      state.transactions = transactions;
    },

    updateTransactionsSuccess(state, action) {
      state.isLoading = false;
      const { id } = action.payload;
      const updateTransactions = state.transactions.map((order: any) => {
        if (order.id === id) {
          return action.payload;
        }
        return order;
      });

      state.transactions = updateTransactions;
    },
  },
});

// Reducer
export default slice.reducer;

// Actions
export const { sortByTransaction, clearTransaction } = slice.actions;

// ----------------------------------------------------------------------

type GetTransactionsProps = {
  step: any;
  page: number;
  filterOrder: any;
  filterName: string;
  order: string;
  orderBy: string;
};

export function getTransactions({
  step,
  page,
  filterName,
  filterOrder,
  order,
  orderBy,
}: GetTransactionsProps) {
  return async () => {
    dispatch(slice.actions.startLoading());
    try {
      const response = await axios.get('/transaction', {
        params: {
          index: page * step,
          step,
          filterName: filterOrder.filterName,
          filterValue: filterOrder.filterValue,
          query: filterName || undefined,
          order,
          orderBy,
        },
      });
      dispatch(slice.actions.getTransactionsSuccess(response.data));
    } catch (error) {
      dispatch(slice.actions.hasError(error));
    }
  };
}

export function getTransactionsValue({ filterName, filterOrder }: any) {
  return async () => {
    dispatch(slice.actions.startLoading());
    try {
      const response = await axios.get('/transaction', {
        params: {
          filterName: filterOrder.filterName,
          filterValue: filterOrder.filterValue,
        },
      });
      dispatch(slice.actions.getTransactionsValueSuccess(response.data));
    } catch (error) {
      dispatch(slice.actions.hasError(error));
    }
  };
}
// ----------------------------------------------------------------------

export function getTransaction(id: string) {
  return async () => {
    dispatch(slice.actions.startLoading());
    try {
      const response = await axios.get(`/transaction/${id}`);
      dispatch(slice.actions.getTransactionSuccess(response.data));
    } catch (error) {
      console.error(error);
      dispatch(slice.actions.hasError(error));
    }
  };
}

// ----------------------------------------------------------------------

export function createTransaction(transaction: any) {
  return async () => {
    dispatch(slice.actions.startLoading());
    try {
      const response = await axios.post(`/transaction`, transaction);
      dispatch(slice.actions.createTransactionSuccess(response.data));
    } catch (error) {
      dispatch(slice.actions.hasError(error));
      throw error;
    }
  };
}

// ----------------------------------------------------------------------

export function updateTransaction(id: string, transaction: any) {
  return async () => {
    dispatch(slice.actions.startLoading());
    try {
      const response = await axios.patch(`/transaction/${id}`, transaction);
      dispatch(slice.actions.updateTransactionsSuccess(response.data));
    } catch (error) {
      dispatch(slice.actions.hasError(error));
      throw error;
    }
  };
}

// ----------------------------------------------------------------------

export function deleteTransaction(id: string) {
  return async () => {
    dispatch(slice.actions.startLoading());
    try {
      await axios.delete(`/transaction/${id}`);
      dispatch(slice.actions.deleteTransactionSuccess(id));
    } catch (error) {
      dispatch(slice.actions.hasError(error));
    }
  };
}
