import axios from 'axios';
import type { AxiosResponse, DefaultResponse, InternalAxiosRequestConfig } from 'axios';


const URI = 'http://192.168.254.102:8000';
const API_URI = 'http://192.168.254.102:8000/api';
// const URI = 'http://localhost:8000';
// const API_URI = 'http://localhost:8000/api';

/**
 * Request Success Handler
 */
const requestSuccessHandler = (config: InternalAxiosRequestConfig<any>) => {
  return config;
};

/**
 * Request Fail Handler
 */
const requestErrorHandler = err => {
  return Promise.reject(err);
};

/**
 * Response Success Handler
 */
const responseSuccessHandler = (res) => {
  const response: DefaultResponse = res.data;
  if (200 <= res.status && res.status < 300) {
    return response;
  } else {
    return responseErrorHandler(res);
  }
};

/**
 * Response Fail handler
 */
const responseErrorHandler = (err: AxiosResponse<any, any>) => {
  return Promise.reject(err);
};

/**
 * Axios
 */
const API = axios.create({
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
    withCredentials: false,
    accesscontrolalloworigin: "*",
    accesscontrolallowMethods: "Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization",
  },
  baseURL: API_URI,
});

/**
 * Axios Request Middleware
 */
API.interceptors.request.use(
  config => requestSuccessHandler(config),
  err => requestErrorHandler(err),
);

/**
 * Axios Response Middleware
 */
API.interceptors.response.use(
  res => responseSuccessHandler(res),
  err => responseErrorHandler(err),
);

export {
  URI,
  API_URI,
  API,
}
