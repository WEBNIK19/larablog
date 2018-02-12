import user from '../../../api/user';
import * as types from '../../mutation-types';

export const login = async ({ dispatch, commit }, payload) => {
    const json = await user.login(payload);

    if (json.status === 1) {
        commit(types.LOGIN, {
            token: json.token,
        });

        await dispatch('getUserCurrent');
    } else if (json.status === 0) {
        throw json;
    }
};

export const logout = async ({ commit }) => {
    commit(types.ID, 0);
    commit(types.NAME, '');
    commit(types.EMAIL, '');
    commit(types.CREATED_AT, '');
    commit(types.UPDATED_AT, '');
    commit(types.LOGOUT);
};

export const register = async ({ dispatch, commit }, payload) => {
    const json = await user.register(payload);

    if (json.status === 1) {
        commit(types.LOGIN, {
            token: json.token,
        });

        await dispatch('getUserCurrent');
    } else if (json.status === 0) {
        throw json;
    }
};

export const passwordEmail = async (context, payload) => {
    const json = await user.passwordEmail(payload);

    if (json.status === 0) {
        throw json;
    }
};

export const resetPassword = async (context, payload) => {
    const json = await user.resetPassword(payload);

    if (json.status === 0) {
        throw json;
    }
};

export const getUserCurrent = async ({ commit }) => {
    const json = await user.getUserCurrent();

    if (json.status === 1) {
        commit(types.ID, json.data.id);
        commit(types.NAME, json.data.name);
        commit(types.EMAIL, json.data.email);
        commit(types.CREATED_AT, json.data.created_at);
        commit(types.UPDATED_AT, json.data.updated_at);
    } else if (json.status === 0) {
        throw json;
    }
};

export const checkLogged = async ({ dispatch, commit }) => {
    const token = window.localStorage.getItem('token');

    if (token !== null) {
        commit(types.LOGIN, {
            token,
        });

        await dispatch('getUserCurrent');
    }
};

export const getAllUsers = async ({ commit }) => {
    const result = await user.getAllUsers();
    if (result.status === 1) {
        commit(types.ALL_USERS, result.data);
        return result;
    }
    throw result;
};

export const getUser = async ({ commit }, payload) => {
    const result = await user.getUser(payload);
    if (result.status === 1) {
        commit(types.GET_USER, result.data);
        return result;
    }
    throw result;
};

export const setUser = async ({ commit }, payload) => {
    const result = await user.setUser(payload);
    if (result.status === 1) {
        commit(types.SET_USER, result.data);
        return result;
    }
    throw result;
};

export const putUser = async ({ commit }, payload) => {
    const result = await user.putUser(payload);
    if (result.status === 1) {
        commit(types.PUT_USER, result.data);
        return result;
    }
    throw result;
};

export const deleteUser = async ({ commit }, payload) => {
    const result = await user.deleteUser(payload);
    if (result.status === 1) {
        commit(types.DELETE_USER, result.data);
        return result;
    }
    throw result;
};

export default {
    login,
    logout,
    register,
    passwordEmail,
    resetPassword,
    getUserCurrent,
    checkLogged,

    getAllUsers,
    getUser,
    setUser,
    putUser,
    deleteUser,
};
