import Axios from 'axios'
export default Axios.create({
    baseURL: `${BASE_URL}/api/`,
    headers: {
        Accept: 'application/json, multipart/form-data',
    },
})
