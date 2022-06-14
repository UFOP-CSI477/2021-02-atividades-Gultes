import axios from 'axios';
// config
import { HOST_API } from '../config';

// ----------------------------------------------------------------------

const accessToken = localStorage.getItem('accessToken');

const axiosInstance = axios.create({
  baseURL: HOST_API,
});

axiosInstance.interceptors.response.use(
  (response) => response,
  (error) => Promise.reject((error.response && error.response.data) || 'Something went wrong')
);

accessToken && (axiosInstance.defaults.headers.common.Authorization = `Bearer ${accessToken}`);

export default axiosInstance;
