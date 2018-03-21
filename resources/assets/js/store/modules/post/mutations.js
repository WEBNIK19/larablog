import * as types from '../../mutation-types';

export default {
	[types.PAGE_POSTS](state, payload) {
		state.PagePosts = payload;
	},
	[types.TODAY_POSTS](state, payload) {
		state.TodayPosts = payload;
	},
	[types.USERS_POSTS](state, payload) {
		state.UsersPosts = payload;
	},
	[types.POST](state, payload) {
		state.Post = payload;
	},
};