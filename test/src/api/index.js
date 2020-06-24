// import qs from 'qs'
import axios from 'axios'
import { getStore } from '../utils/storage'
const AUTH_TOKEN = getStore('token') ? getStore('token') : ''

// 引用axios
axios.defaults.baseURL = process.env.API_HOST
axios.defaults.timeout = 20000
axios.defaults.headers.common['Authorization'] = 'Bearer ' + AUTH_TOKEN
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'
axios.defaults.headers.post['Content-Type'] = 'application/json'
axios.defaults.headers.put['Content-Type'] = 'application/json'
// axios.defaults.transformRequest = [function (data) { return qs.stringify(data) }]
// axios.defaults.paramsSerializer = function (params) { return qs.stringify(params, {arrayFormat: 'brackets'}) }

function apiAxios (method, url, params) {
  return new Promise((resolve, reject) => {
    axios({
      method: method,
      url: url,
      data: method === 'POST' || method === 'PUT' ? params : null,
      params: method === 'GET' || method === 'DELETE' ? params : null,
      withCredentials: false
    }).then(res => {
      resolve(res.data)
    }).catch(err => {
      reject(err)
    })
  })
}

axios.interceptors.request.use(function (config) {
  // 配置config
  if (!AUTH_TOKEN) {
    window.location.href = '/hackthon/login'
  }


  config.headers.Accept = 'application/json'
  return config
})
axios.interceptors.response.use(res => {
  let status = res.status
  if (status === 200) {
    return Promise.resolve(res)
  } else {
    return Promise.reject(res)
  }
})

// 返回到vue模板中的调用接口
export default {
  get: function (url, params) {
    return apiAxios('GET', url, params)
  },
  post: function (url, params) {
    return apiAxios('POST', url, params)
  },
  put: function (url, params) {
    return apiAxios('PUT', url, params)
  },
  delete: function (url, params) {
    return apiAxios('DELETE', url, params)
  }
}
