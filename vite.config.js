import { defineConfig } from "vite";

export default defineConfig({
	base: "./",
	build: {
		outDir: "build",
		emptyOutDir: true,
		rollupOptions: {
			input: "src/admin.js",
			output: {
				entryFileNames: "[name].js",
				chunkFileNames: "[name].js",
				assetFileNames: "[name].[ext]",
			},
		},
	},
});
