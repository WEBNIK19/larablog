export default {
    async login(params) {
        const json = await window.axios.post('/api/login', params);
       
        return json.data;
    },
    async register(params) {
        const json = await window.axios.post('/api/register', params);
        return json.data;
    },
    async passwordEmail(params) {
        const json = await window.axios.post('/api/password/email', params);
        return json.data;
    },
    async resetPassword(params) {
        const json = await window.axios.post('/api/reset/password', params);
        return json.data;
    },
    async getUserCurrent() {
        const json = await window.axios.get('/api/user/current');
        return json.data;
    },
    async getAllUsers(params) {
        const json = await window.axios.get('/api/user/all', { params });
        return json.data;
    },
     async getUser(params) {
        const json = await window.axios.get('/api/user', { params });
        return json.data;
    },
    async putUser(params) {
        const json = await window.axios.put('/api/user', { params });
        console.log(json.data);
        return json.data;
    },
    async deleteUser(params) {
        const json = await window.axios.delete('/api/user',{ params });
        console.log(json.data);
        return json.data;
    },
    async setUser(params) {
        const json = await window.axios.post('/api/user', params);
        return json.data;
    },
    async getAllTypes() {
        const json = await window.axios.get('/api/type/all');
        
        return json.data;
    },
};
