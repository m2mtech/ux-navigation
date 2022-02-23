module.exports = {
    root: true,
    parser: '@typescript-eslint/parser',
    plugins: ['@typescript-eslint'],
    extends: [
        'eslint:recommended',
        'prettier',
        'plugin:@typescript-eslint/eslint-recommended',
        'plugin:@typescript-eslint/recommended',
    ],
    rules: {
        '@typescript-eslint/no-explicit-any': 'off',
        '@typescript-eslint/no-empty-function': 'off',
    },
    env: {
        browser: true,
    },
    overrides: [
        {
            files: ['src/*/Resources/assets/test/**/*.ts', 'src/*/assets/test/**/*.ts'],
            extends: ['plugin:jest/recommended'],
        },
    ],
};
