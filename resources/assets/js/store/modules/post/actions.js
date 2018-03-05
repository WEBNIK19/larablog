import post from '../../../api/post';

import * as types from '../../mutation-types';

export const getPagePosts = async ({ commit }, payload) => {
	const json = await post.getAllPosts(payload);
	commit(types.PAGE_POSTS, json.data);
	if(json.status === 1){
		return json;
	} else {
		throw json;
	}
};

export const getTodayPosts = async ({ commit }) => {
const json = await post.getTodayPosts();
	if(json.status === 1) {
		commit(types.TODAY_POSTS, json.data);
		return json;
	} else {
		throw json;
	}
};

export const getUsersPosts = async ({ commit }, payload) => {
const json = await post.getUsersPosts(payload);
	if(json.stats === 1) {
		commit(types.USERS_POSTS, json.data);
		return json;
	} else {
		throw json;
	}
};

export const getPost = async ({ commit },payload) => {
const json = await post.getPost(payload);
	if(json.status === 1) {
		commit(types.POST, json.data);
		return json;
	} else {
		throw json;
	}
};

export const setPost = async (payload) => {
	const json = await post.setPost(payload);
	if(json.status === 1) {
		return json;
	} else {
		throw json;
	}
};

export const putPost = async (payload) => {
	const json = await post.putPost(payload);
	if(json.status === 1) {
		return json;
	} else {
		throw json;
	}
};

export const deletePost = async (payload) => {
	const json = await post.deletePost(payload);
	if(json.status === 1) {
		return json;
	} else {
		throw json;
	}
};

