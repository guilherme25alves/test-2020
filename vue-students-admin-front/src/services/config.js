import axios from 'axios'

var baseUrl = 'http://127.0.0.1:8000/api/v1/';

export const http = axios.create({
    baseURL: baseUrl
})