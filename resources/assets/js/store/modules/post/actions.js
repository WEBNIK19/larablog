import post from '../../../api/post';

import * as types from '../../mutation-types';

export const getAllPosts = async ({ commit }, payload) => {
	const json = await post.getAllPosts(payload.data);
	if(json.status === 1){
		commit(types.PAGE_POSTS, json.data.posts);
		return json.data;
	} else {
		throw json.data;
	}
};

export const getTodayPosts = async ({ commit }, payload) => {
const json = await post.getTodayPosts(payload.data);
console.log(json);
	if(json.status === 1) {
		commit(types.PAGE_POSTS, json.data.posts);
		return json;
	} else {
		throw json;
	}
};

export const getUsersPosts = async ({ commit }, payload) => {
const json = await post.getUsersPosts(payload.data);
	if(json.stats === 1) {
		commit(types.PAGE_POSTS, json.data.posts);
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

export const searchPost = async ({ commit }, payload) => {
	const json = await post.searchPost(payload);
	if(json.status === 1) {
		return json;
	} else {
		throw json;
	}
};

export default{
	getAllPosts,
getTodayPosts,
getUsersPosts,
getPost,
setPost,
putPost,
deletePost,
};

