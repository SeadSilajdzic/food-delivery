import js from "@eslint/js";
import eslintPluginVue from "eslint-plugin-vue";
import vueParser from "vue-eslint-parser";

export default [
    js.configs.recommended,
    {
        files: ["**/*.vue", "**/*.js"],
        languageOptions: {
            parser: vueParser,
            parserOptions: {
                ecmaVersion: "latest",
                sourceType: "module",
            },
            globals: {
                window: true,
                document: true,
                setTimeout: true,
                FormData: true,
                URLSearchParams: true,
                Blob: true,
                navigator: true,
                self: true,
                Event: true,
                global: true,
                process: true,
                WorkerGlobalScope: true,
                queueMicrotask: true,
                setImmediate: true,
                Buffer: true,
                route: true,
            },
        },
        plugins: {
            vue: eslintPluginVue,
        },
        rules: {
            ...eslintPluginVue.configs["vue3-essential"].rules,
            "vue/multi-word-component-names": "off",
            "no-console": "warn",
            "no-debugger": "warn",
        },
    },
    {
        ignores: ["node_modules/**", "public/build/**", "dist/**", "vendor/**"],
    },
];
