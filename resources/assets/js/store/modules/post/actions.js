import post from '../../../api/post';

import * as types from '../../mutation-types';

export const getAllPosts = async ({ commit }, payload) => {
    const json = await post.getAllPosts(payload.data);
    if (json.status === 1) {
        console.log(json.data.posts);
        commit(types.PAGE_POSTS, json.data.posts);
        return json.data;
    }
    throw json;
};

export const getTodayPosts = async ({ commit }, payload) => {
    const json = await post.getTodayPosts(payload.data);
    console.log(json.data);
    if (json.status === 1) {
        commit(types.PAGE_POSTS, json.data.posts);
        return json;
    }
    throw json;
};

export const getUsersPosts = async ({ commit }, payload) => {
    const json = await post.getUsersPosts(payload.data);
    console.log(json.data);
    if (json.stats === 1) {
        commit(types.PAGE_POSTS, json.data.posts);
        return json;
    }
    throw json;
};

export const getPost = async ({ commit }, payload) => {
    const json = await post.getPost(payload);
    if (json.status === 1) {
        commit(types.POST, json.data);
        return json;
    }
    throw json;
};

export const setPost = async (payload) => {
    const json = await post.setPost(payload);
    if (json.status === 1) {
        return json;
    }
    throw json;
};

export const putPost = async (payload) => {
    const json = await post.putPost(payload);
    if (json.status === 1) {
        return json;
    }
    throw json;
};

export const deletePost = async (payload) => {
    const json = await post.deletePost(payload);
    if (json.status === 1) {
        return json;
    }
    throw json;
};

export const searchPost = async ({ commit }, payload) => {
    const json = await post.searchPost(payload.data);
    if (json.status === 1) {
        console.log(json.data);
        commit(types.PAGE_POSTS, json.data.posts);
        return json;
    }
    throw json;
};

export default{
    getAllPosts,
    getTodayPosts,
    getUsersPosts,
    getPost,
    setPost,
    putPost,
    deletePost,
    searchPost,
};

