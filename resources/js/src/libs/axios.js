import Vue from 'vue'

// axios
import axios from 'axios'

const axiosIns = axios.create({
  baseURL: app_url+'/api/',
})
axiosIns.interceptors.request.use(function (config) {
  return config;
}, function (error) {
  return Promise.reject(error);
});

axiosIns.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 401) {
      localStorage.removeItem('userData')
      localStorage.removeItem('accessToken')
      localStorage.removeItem('userAbilities')
      window.location.replace('/login')
    }
    return error.response
  });
Vue.prototype.$http = axiosIns

export default axiosIns
