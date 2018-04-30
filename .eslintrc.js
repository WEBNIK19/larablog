module.exports = {
    "root": true,
    "parser": "babel-eslint",
    "env": {
        "browser": true,
    },
    "extends": "airbnb-base",
    "plugins": [
        "html"
    ],
    "parserOptions": {
        "sourceType": "module"
    },
    "rules": {
        "no-param-reassign": 0,
        "no-multi-assign": 0,
        "indent": [
            "error",
            4
        ],
        "linebreak-style": [
            "off",
            "windows"
        ],
        "quotes": [
            "error",
            "single"
        ],
        "semi": [
            "error",
            "always"
        ],
        "no-console": "off",
        "import/extensions": ["error", "always", {
            "js": "never",
            "vue": "never"
        }]
    }
};