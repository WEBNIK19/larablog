export default {
    async login(params) {
        const result = await window.axios.post('/api/login', params);

        return result.data;
    },
    async register(params) {
        const result = await window.axios.post('/api/register', params);

        return result.data;
    },
    async passwordEmail(params) {
        const result = await window.axios.post('/api/password/email', params);

        return result.data;
    },
    async resetPassword(params) {
        const result = await window.axios.post('/api/reset/password', params);

        return result.data;
    },
    async getUserCurrent() {
        const result = await window.axios.get('/api/user/current');

        return result.data;
    },
    async getAllUsers(params) {
        const json = await window.axios.get('/api/user/all', { params });
        return json.data;
    },
};
