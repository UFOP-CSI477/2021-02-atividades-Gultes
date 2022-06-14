import { combineReducers } from 'redux';
import storage from 'redux-persist/lib/storage';

import transactionReducer from './slices/transaction';

const rootPersistConfig = {
  key: 'root',
  storage,
  keyPrefix: 'redux-',
  whitelist: [],
};

const rootReducer = combineReducers({
  transaction: transactionReducer,
});

export { rootPersistConfig, rootReducer };
