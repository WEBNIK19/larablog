export default {
    id: state => state.id,
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
    User: state => state.User,
    allTypes: state => state.allTypes,
};
