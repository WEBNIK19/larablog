import * as types from '../../mutation-types';

export default {
	[types.PAGE_POSTS](state, payload) {
		state.PagePosts = payload;
	},
	[types.POST](state, payload) {
		state.Post = payload;
	},
};