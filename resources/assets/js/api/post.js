export default {
	async getPagePosts (params) {
		const json = window.axios.get('/api/post/page' { params });
		return json.data;
	},

	async getTodayPosts () {
		const json = window.axios.get('/api/post/today');
		return json.data;
	},

	async getUsersPosts(params) {
		const json = window.axios.get('api/post/user', { params });
		return json.data;
	},

	async getPost (params) {
		const json = window.axios.get('api/post', { params });
		return json.data;
	},

	async setPost (params) {
		const json = window.axios.post('api/post', params);
		return json.data;
	},

	async putPost (params) {
		const json = window.axios.put('api/post', { params });
		return json.data;
	},

	async deletePost (params) {
		const json = window.axios.delete('api/post', { params });
		return json.data;
	},
};