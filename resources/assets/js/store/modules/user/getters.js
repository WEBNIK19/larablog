export default {
    id: state => state.id,
    user_id: state => state.user_id,
    name: state => state.name,
    email: state => state.email,
    logged: state => state.logged,
    token: state => state.token,
    password: state => state.password,
    passwordConfirmation: state => state.passwordConfirmation,
    typeUserId: state => state.typeUserId,
    createdAt: state => state.createdAt,
    updatedAt: state => state.updatedAt,

    allUsers: state => state.allUsers,
    getUser: state => state.getUser,
    putUser: state => state.putUser,
    setUser: state => state.setUser,
    deleteUser: state => state.deleteUser,
};
