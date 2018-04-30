export default {
    async getAllPosts(params) {
        const json = await window.axios.get('/api/post/all', { params });
        console.log(json.data);
        return json.data;
    },

    async getTodayPosts(params) {
        const json = await window.axios.get('/api/post/today', { params });
        return json.data;
    },

    async getUsersPosts(params) {
        const json = await window.axios.get('/api/post/user', { params });
        return json.data;
    },

    async getPost(params) {
        const json = await window.axios.get('/api/post', { params });
        return json.data;
    },

    async setPost(params) {
        const json = await window.axios.post('/api/post', params);
        return json.data;
    },

    async putPost(params) {
        const json = await window.axios.put('/api/post', { params });
        return json.data;
    },

    async deletePost(params) {
        const json = await window.axios.delete('/api/post', { params });
        return json.data;
    },

    async searchPost(params) {
        const json = await window.axios.get('/api/post/search', { params });
        return json.data;
    },
};
